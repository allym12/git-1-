let checkPayTimeout; // Variable to store the interval ID

function initiatePayment() {
    // Get the form element
    const form = document.getElementById('paymentForm');

    // Get the loader element
    const loader = form.querySelector('#paymentLoader');
    const payButton = form.querySelector('#buttondPay')

    // Validate the form fields
    const phone = form.querySelector('input[name="phone"]').value.trim();

    if (phone === '') {
        alert('Number is required.');
        return false;
    }

    if (!validatePhoneNumber(phone)) {
        // The input does not match the pattern or is empty
        alert('Invalid phone number!');
        return false; // Prevent form submission
    }

    // Show the loader
    loader.style.display = 'block';

    // Hide pay button
    payButton.style.display = 'none';

    doAjaxCall(
        "/api/initiate_permit_payment", 
        'POST',
        new FormData($('.paymentForm')[0]),
        (data) => {
            if(data.success){
                console.log('Payment pending');
                checkPaymentStatus(data.refid, phone, data.tid);
            }
            else{
                console.log(data);
                alert('Payment error occurred. Please try again later.');
                loader.style.display = 'none';
                payButton.style.display = 'block';
                return false;
            }
            

        },
        null,
        (data) => {
            console.log(data);
            alert('Payment error occurred. Please try again later.');
            loader.style.display = 'none';
            payButton.style.display = 'block';
            return false;
        }
    );

}

function validatePhoneNumber(phoneNumber) {
    // Define the regular expression pattern for a 10-digit phone number
    const phonePattern = /^[0-9]{10}$/;
  
    // Use the test() method of the regular expression to check if the phoneNumber matches the pattern
    return phonePattern.test(phoneNumber);
}

// Start the interval with a specified time (e.g., 1000ms = 1 second)


function checkPaymentStatus(refid, phone, tid) {
    console.log('a call to check transaction status');
    // Get the form element
    const form = document.getElementById('paymentForm');

    // Get the loader element
    const loader = form.querySelector('#paymentLoader');
    const payButton = form.querySelector('#buttondPay');

    doAjaxCall(
        "/check_transaction/?refid=" + refid + "&phone=" + phone + "&tid=" + tid,
        'get',
        [],
        (data) => {
            if (data.status == "success") {
                console.log('Payment completed');
                window.location.reload();
            } else if (data.status == "failed") {
                console.log(data);
                alert('Payment error occurred. Please try again later.');
                loader.style.display = 'none';
                payButton.style.display = 'block';
                window.location.reload();
            } else {
                console.log('Payment is still pending');
                // Schedule the next check after 3 seconds
                checkPayTimeout = setTimeout(() => checkPaymentStatus(refid, phone, tid), 1000);
            }
        },
        null,
        (data) => {
            console.log(data);
            alert('Payment error occurred. Please try again later.');
            loader.style.display = 'none';
            payButton.style.display = 'block';
            window.location.reload();
        }
    );
}

// To clear the timeout when needed (e.g., when the user cancels or completes the payment)
function clearCheckPaymentTimeout() {
    clearTimeout(checkPayTimeout);
}
