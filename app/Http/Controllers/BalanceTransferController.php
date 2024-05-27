<?php

namespace App\Http\Controllers;

use App\Http\Requests\BalanceRequest;
use App\Models\BalanceHistory;
use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\BasketItemType;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\CheckoutFormInitialize;
use Iyzipay\Model\Currency;
use Iyzipay\Model\Locale;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Options;
use Iyzipay\Request\CreateCheckoutFormInitializeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Traits\BalanceTrait;
use Illuminate\Support\Facades\Auth;

class BalanceTransferController extends Controller
{
    public function __construct(BalanceTrait $balanceTrait)
    {
        $this->balanceTrait = $balanceTrait;
    }

    public function index()
    {
        $data = $this->balanceTrait->requiredData();

        $userBalance = $data['userBalance'];
        $totalBalance = $data['totalBalance'];
        $paymentModels = $data['paymentModels'];
        $lastId = $data['lastId'];

        return view('balance.index', ['userBalance' => $userBalance, 'totalBalance' => $totalBalance, 'paymentModels' => $paymentModels, 'lastId' => $lastId]);
    }

    public function store(BalanceRequest $request)
    {
        $lastId = BalanceHistory::latest('id')->first();
        $data = $this->balanceTrait->requiredData();

        $userBalance = $data['userBalance'];
        $totalBalance = $data['totalBalance'];
        $paymentModels = $data['paymentModels'];
        $lastId = $data['lastId'];

        $request->validated();

        if($request->amount < 1){
            return redirect()->route('balance.index')->with('error', 'Lütfen geçerli bir değer giriniz...', ['userBalance' => $userBalance, 'totalBalance' => $totalBalance, 'paymentModels' => $paymentModels, 'lastId' => $lastId]);
        }

        $balance = new BalanceHistory();
        $balance->user_id = auth()->id();
        $balance->amount = $request->amount;
        $balance->type = $request->payment_method;
        $balance->status = 'pending';
        $balance->save();

        if (!$balance) {
            return redirect()->route('balance.index')->with('error', 'Bakiye Transfer İsteği Gönderilemedi...', ['userBalance' => $userBalance, 'totalBalance' => $totalBalance, 'paymentModels' => $paymentModels, 'lastId' => $lastId]);
        }
        $id = $balance->id;

        if ($request->payment_method == 'credit-card') {

            $options = new Options();
            $options->setApiKey(env('IYZICO_API_KEY'));
            $options->setSecretKey(env('IYZICO_SECRET_KEY'));
            $options->setBaseUrl(env('IYZICO_BASE_URL'));

            $request = new CreateCheckoutFormInitializeRequest();
            $request->setLocale(Locale::TR);
            $request->setConversationId($id);

            $request->setPrice($balance->amount);
            $request->setPaidPrice($balance->amount);
            $request->setCurrency(Currency::TL);
            $request->setBasketId($id);
            $request->setPaymentGroup(PaymentGroup::PRODUCT);
            $request->setCallbackUrl(route('balance.return', ['balance_id' => $id, 'user_id' => auth()->id()]));
            $request->setEnabledInstallments(array(2, 3, 6, 9));

            $name = explode(' ', auth()->user()->name);

            $buyer = new Buyer();
            $buyer->setId(auth()->id());
            $buyer->setName($name[0] ?? '-');
            $buyer->setSurname($name[1] ?? '-');
            $buyer->setGsmNumber(auth()->user()->phone);
            $buyer->setEmail(auth()->user()->email);
            $buyer->setIdentityNumber("100000");
            $buyer->setLastLoginDate(Carbon::now()->toDateTimeString());
            $buyer->setRegistrationDate(auth()->user()->created_at->toDateTimeString());
            $buyer->setRegistrationAddress("-");
            $buyer->setIp(request()->ip());
            $buyer->setCity("Istanbul");
            $buyer->setCountry("Turkey");
            $buyer->setZipCode("12345");
            $request->setBuyer($buyer);

            $shippingAddress = new Address();
            $shippingAddress->setContactName(auth()->user()->name);
            $shippingAddress->setCity("Istanbul");
            $shippingAddress->setCountry("Turkey");
            $shippingAddress->setAddress("-");
            $shippingAddress->setZipCode("12345");
            $request->setShippingAddress($shippingAddress);

            $billingAddress = new Address();
            $billingAddress->setContactName(auth()->user()->name);
            $billingAddress->setCity("Istanbul");
            $billingAddress->setCountry("Turkey");
            $billingAddress->setAddress("-");
            $billingAddress->setZipCode("12345");
            $request->setBillingAddress($billingAddress);

            $basketItems = array();

            $firstBasketItem = new BasketItem();
            $firstBasketItem->setId($id);
            $firstBasketItem->setName("Balance Transfer");
            $firstBasketItem->setCategory1("Balance Transfer");
            $firstBasketItem->setItemType(BasketItemType::VIRTUAL);
            $firstBasketItem->setPrice($balance->amount);
            $basketItems[0] = $firstBasketItem;

            $request->setBasketItems($basketItems);

            $checkoutFormInitialize = CheckoutFormInitialize::create($request, $options);
            $paymentinput = $checkoutFormInitialize->getCheckoutFormContent();
            // dd($paymentinput);
            return redirect()->route('balance.index', ['userBalance' => $userBalance, 'totalBalance' => $totalBalance, 'paymentModels' => $paymentModels, 'lastId' => $lastId, 'paymentinput' => $paymentinput]);
        }

        return redirect()->route('balance.index')->with('success', 'Bakiye Transfer İsteği Gönderildi...');
    }

    public function return(Request $request)
    {
        Auth::loginUsingId($request->user_id);

        $data = $this->balanceTrait->requiredData();

        $userBalance = $data['userBalance'];
        $totalBalance = $data['totalBalance'];
        $paymentModels = $data['paymentModels'];
        $lastId = $data['lastId'];


        $balance = BalanceHistory::find($request->balance_id);
        if (!$balance) {
            return redirect()->route('balance.index')->with('error', 'Bakiye Transfer İsteği Bulunamadı...', ['userBalance' => $userBalance, 'totalBalance' => $totalBalance, 'paymentModels' => $paymentModels, 'lastId' => $lastId]);
        }

        $this->balanceTrait->updateBalance($request->user_id, $balance->amount);

        $balance->status = 'success';
        $balance->token = $request->token;
        $balance->save();

        return redirect()->route('balance.index')->with('success', 'Bakiye Başarılı bir şekilde yüklendi...', ['userBalance' => $userBalance, 'totalBalance' => $totalBalance, 'paymentModels' => $paymentModels, 'lastId' => $lastId]);
    }
}
