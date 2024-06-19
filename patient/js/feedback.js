document.addEventListener("DOMContentLoaded", function () {
    let feedbackTable = document.getElementById("feedbackTable").getElementsByTagName('tbody')[0];
    let feedbacks = [
        { id: 1, doctor: "Dr. Smith", date: "2023-01-15", feedback: "Great service!" },
        { id: 2, doctor: "Dr. Jones", date: "2023-02-20", feedback: "Good experience" },
        { id: 3, doctor: "Dr. Brown", date: "2023-03-10", feedback: "Satisfactory" }
    ];

    function renderTable() {
        feedbackTable.innerHTML = '';
        feedbacks.forEach(feedback => {
            let row = feedbackTable.insertRow();
            row.innerHTML = `
                <td>${feedback.id}</td>
                <td>${feedback.doctor}</td>
                <td>${feedback.date}</td>
                <td>${feedback.feedback}</td>
                <td>
                    <button class="button" onclick="showForm('edit', ${feedback.id})">Edit</button>
                    <button class="button" onclick="deleteFeedback(${feedback.id})">Delete</button>
                </td>
            `;
        });
    }

    window.showForm = function (action, id = null) {
        const formContainer = document.getElementById('feedbackForm');
        const feedbackId = document.getElementById('feedbackId');
        const doctorName = document.getElementById('doctorName');
        const feedbackDate = document.getElementById('feedbackDate');
        const feedbackText = document.getElementById('feedbackText');

        if (action === 'add') {
            feedbackId.value = '';
            doctorName.value = '';
            feedbackDate.value = '';
            feedbackText.value = '';
        } else if (action === 'edit' && id !== null) {
            const feedback = feedbacks.find(f => f.id === id);
            if (feedback) {
                feedbackId.value = feedback.id;
                doctorName.value = feedback.doctor;
                feedbackDate.value = feedback.date;
                feedbackText.value = feedback.feedback;
            }
        }

        formContainer.classList.add('active');
    };

    window.hideForm = function () {
        const formContainer = document.getElementById('feedbackForm');
        formContainer.classList.remove('active');
    };

    window.submitFeedback = function () {
        const feedbackId = document.getElementById('feedbackId').value;
        const doctorName = document.getElementById('doctorName').value;
        const feedbackDate = document.getElementById('feedbackDate').value;
        const feedbackText = document.getElementById('feedbackText').value;

        if (doctorName && feedbackDate && feedbackText) {
            if (feedbackId) {
                const feedback = feedbacks.find(f => f.id === parseInt(feedbackId));
                feedback.doctor = doctorName;
                feedback.date = feedbackDate;
                feedback.feedback = feedbackText;
            } else {
                const newId = feedbacks.length ? feedbacks[feedbacks.length - 1].id + 1 : 1;
                feedbacks.push({ id: newId, doctor: doctorName, date: feedbackDate, feedback: feedbackText });
            }
            renderTable();
            hideForm();
        }
    };

    window.deleteFeedback = function (id) {
        feedbacks = feedbacks.filter(f => f.id !== id);
        renderTable();
    };

    renderTable();
});