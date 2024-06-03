// Function to get the value of a specific URL parameter
function getURLParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

// Function to set a cookie
function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Get the 'ref' parameter from the URL
const ref = getURLParameter("ref");
const campaign = getURLParameter("campaign");

// If 'ref' parameter exists, set it as a cookie
if (ref) {
    setCookie("refCode", ref, 15); // Set the cookie to expire in 15 days
    setCookie("campaign", campaign, 15); // Set the cookie to expire in 15
}

// For debugging purposes: log the cookie value
console.log(
    "Reference code and Campaign accepted. (" + ref + " - " + campaign + ")"
);
