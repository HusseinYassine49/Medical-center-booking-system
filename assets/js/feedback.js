const feedbackData = [
    { id: 1, text: "Great website!", status: "pending", patient: "John Doe" },
    { id: 2, text: "Could use more features.", status: "pending", patient: "Alice Smith" },
    { id: 3, text: "I found a bug.", status: "pending", patient: "Bob Johnson" }
];


let acceptedFeedback = [];
let declinedFeedback = [];


function renderFeedbackItems() {
    const feedbackList = document.getElementById("feedback-list");
    feedbackList.innerHTML = "";
    feedbackData.forEach(feedback => {
        const row = document.createElement("tr");
        // Add a class based on the feedback status
        row.classList.add(feedback.status);
        // Create table cells for ID, Patient, Feedback, Status, and Actions
        row.innerHTML = `
            <td>${feedback.id}</td>
            <td>${feedback.patient}</td>
            <td>${feedback.text}</td>
            <td class="status">${feedback.status}</td>
            <td>
                <button data-id="${feedback.id}" data-action="accept" onclick="acceptFeedback(${feedback.id})" ${feedback.status !== 'pending' ? 'disabled' : ''}>Accept</button>
                <button data-id="${feedback.id}" data-action="decline" onclick="declineFeedback(${feedback.id})" ${feedback.status !== 'pending' ? 'disabled' : ''}>Decline</button>
            </td>
        `;
        feedbackList.appendChild(row);
    });
    renderAcceptedFeedback();
    renderDeclinedFeedback();
}




//THIS CODE IS FOR THE FEEDBACK PAGE TO SHOW IN THE TABLE BOTH FOR ACCEPT AND DECLINE
function renderAcceptedFeedback() {
    const acceptedList = document.getElementById("accepted-feedback-list");
    acceptedList.innerHTML = ""; 
    acceptedFeedback.forEach(feedback => {
        const row = document.createElement("tr");

        row.innerHTML = `
            <td>${feedback.id}</td>
            <td>${feedback.patient}</td>
            <td>${feedback.text}</td>
            <td class="status">${feedback.status}</td>
            <td>Accepted</td>
        `;
        acceptedList.appendChild(row);
    });
}
function renderDeclinedFeedback() {
    const declinedList = document.getElementById("declined-feedback-list");
    declinedList.innerHTML = ""; 
    declinedFeedback.forEach(feedback => {
        const row = document.createElement("tr");

        row.innerHTML = `
            <td>${feedback.id}</td>
            <td>${feedback.patient}</td>
            <td>${feedback.text}</td>
            <td class="status">${feedback.status}</td>
            <td>Declined</td>
        `;
        declinedList.appendChild(row);
    });
}




//THIS CODE IS SEND JASON DATA TO THE FEEDBACKINFO PAGE FOR BOTH ACCEPT AND DECLINE
function acceptFeedback(id) {
    // Find the feedback with the given id
    const feedbackIndex = feedbackData.findIndex(item => item.id === id);
    if (feedbackIndex !== -1) {
        // Update the status of the feedback
        feedbackData[feedbackIndex].status = "accepted";  
        // Move the feedback to accepted array if needed (optional)
        const acceptedItem = feedbackData[feedbackIndex];
        acceptedFeedback.push(acceptedItem);
        // Store accepted feedback data in session storage (optional)
        sessionStorage.setItem('acceptedFeedback', JSON.stringify(acceptedFeedback));
        // Perform further actions (e.g., send to backend)
        console.log(`Feedback "${acceptedItem.text}" accepted.`); 
        // Disable the accept button and change the color of the border and status
        const acceptButton = document.querySelector(`button[data-id="${id}"][data-action="accept"]`);
        acceptButton.disabled = true;
        acceptButton.parentElement.parentElement.classList.add('accepted'); // Add a class for styling
        acceptButton.parentElement.previousElementSibling.textContent = "Accepted"; // Change status text  
        // Re-render feedback list
        renderFeedbackItems();
    }
}
// Function to decline feedback
function declineFeedback(id) {
    // Find the feedback with the given id
    const feedbackIndex = feedbackData.findIndex(item => item.id === id);
    if (feedbackIndex !== -1) {
        // Update the status of the feedback
        feedbackData[feedbackIndex].status = "declined"; 
        // Move the feedback to declined array if needed (optional)
        const declinedItem = feedbackData[feedbackIndex];
        declinedFeedback.push(declinedItem);
        // Store declined feedback data in session storage (optional)
        sessionStorage.setItem('declinedFeedback', JSON.stringify(declinedFeedback));
        // Perform further actions (e.g., send to backend)
        console.log(`Feedback "${declinedItem.text}" declined.`);      
        // Disable the decline button and change the color of the border and status
        const declineButton = document.querySelector(`button[data-id="${id}"][data-action="decline"]`);
        declineButton.disabled = true;
        declineButton.parentElement.parentElement.classList.add('declined'); // Add a class for styling
        declineButton.parentElement.previousElementSibling.textContent = "Declined"; // Change status text     
        // Re-render feedback list
        renderFeedbackItems();
    }
}


function viewFeedbackInfo() {
    window.location.href = "feedbackinfo.html";
}

renderFeedbackItems();
