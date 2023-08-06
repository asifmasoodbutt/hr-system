// function generating a message with a random title and text
function generateMessage(title, heading, successMessage) {

    const message = document.querySelector('.notification__message');

    message.querySelector('h1').textContent = heading;
    message.querySelector('p').textContent = successMessage;
    message.className = `notification__message message--${title}`;

    // call the function to show the message
    showMessage();
}

const notification = document.querySelector('.notification');

// function called when the button to dismiss the message is clicked
function dismissMessage() {
    // remove the .received class from the .notification widget
    notification.classList.remove('received');
}

// function showing the message
function showMessage() {
    // add a class of .received to the .notification container
    notification.classList.add('received');
    const button = document.querySelector('.notification__message button');
    button.addEventListener('click', dismissMessage, { once: true });
}