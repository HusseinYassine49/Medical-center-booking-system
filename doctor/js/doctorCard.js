document.addEventListener("DOMContentLoaded", function () {
    let currentFlippedCard = null;

    function createAvailabilityCard(day, slots) {
        const card = document.createElement("div");
        card.className = "availability-card";
        card.dataset.day = day;

        const front = document.createElement("div");
        front.className = "front";
        front.textContent = day;

        const back = document.createElement("div");
        back.className = "back";
        back.innerHTML = `
            <span class="close-btn">&times;</span>
            <div class="day-name">${day}</div>
            <div class="time-range">
                ${slots.map(slot => createAvailabilitySlot(slot)).join('')}
            </div>
        `;

        card.appendChild(front);
        card.appendChild(back);

        card.addEventListener("click", function () {
            if (currentFlippedCard && currentFlippedCard !== card) {
                return;
            }
            card.classList.toggle("flipped");
            currentFlippedCard = card.classList.contains("flipped") ? card : null;
        });

        const closeBtn = back.querySelector(".close-btn");
        closeBtn.addEventListener("click", function (event) {
            event.stopPropagation();
            card.classList.remove("flipped");
            currentFlippedCard = null;
        });

        return card;
    }

    function createAvailabilitySlot(slot) {
        return `
            <div class="time-slot">
                <i class="fa fa-clock"></i> ${slot.start_time} - ${slot.end_time}
                <hr>
            </div>
        `;
    }

    function createNoAvailabilityCard(day) {
        const card = document.createElement("div");
        card.className = "availability-card Noavailability";
        card.dataset.day = day;

        const dayHeader = document.createElement("div");
        dayHeader.className = "day-header";
        dayHeader.textContent = day;

        const timeRange = document.createElement("div");
        timeRange.className = "notime";
        timeRange.textContent = "No availability";

        card.appendChild(dayHeader);
        card.appendChild(timeRange);

        return card;
    }

    

    function fetchAndDisplayAvailability() {
        $.ajax({
            type: 'GET',
            url: 'fetchAvailability.php',
            dataType: 'json',
            success: function (data) {
                const container = document.getElementById("availability-container");
                const daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

                daysOfWeek.forEach(day => {
                    const slots = data.filter(slot => slot.day === day);
                  
                    if (slots.length > 0) {
                        const card = createAvailabilityCard(day, slots);
                        container.appendChild(card);
                    } else {
                        const card = createNoAvailabilityCard(day);
                        container.appendChild(card);
                    }
                });
            },
            error: function (error) {
                console.error('Error fetching availability data:', error);
            }
        });
    }

    fetchAndDisplayAvailability();

    const saveButton = document.getElementById("save-availability-button");
    saveButton.addEventListener("click", function (event) {
        event.preventDefault();

        var selectedTimes = [];
        $('thead th').each(function (index) {
            var day = $(this).text().trim();
            var startTime = $('tbody tr:eq(0) td:eq(' + index + ') input').val();
            var endTime = $('tbody tr:eq(1) td:eq(' + index + ') input').val();
            if (startTime && endTime) {
                selectedTimes.push({
                    day: day,
                    start_time: startTime,
                    end_time: endTime
                });
            }
        });

        var doctorAvailability = {
            availability: selectedTimes
        };

        $.ajax({
            type: 'POST',
            url: 'saveAvailability.php',
            data: JSON.stringify(doctorAvailability),
            contentType: 'application/json',
            success: function (response) {
                alert('Availability saved successfully!');
                window.location.reload();
            },
            error: function (error) {
                alert('Error saving availability.');
            }
        });
    });

    const editButton = document.getElementById("edit-button");
    const saveLinksButton = document.getElementById("save-links-button");
    const description = document.getElementById("description");
    const editDescription = document.getElementById("editdescription");
    const linkedinInput = document.getElementById("linkedin");
    const optionalLink1Input = document.getElementById("optional-link1");
    const optionalLink2Input = document.getElementById("optional-link2");

    editButton.addEventListener("click", function (event) {
        event.preventDefault();

        description.style.display = "none";
        editDescription.style.display = "block";

        [linkedinInput, optionalLink1Input, optionalLink2Input].forEach(input => {
            if (input) {
                input.removeAttribute("readonly");
            } else {
                console.log("Input element not found:", input);
            }
        });
        saveLinksButton.style.display = "block";
        editButton.style.display = "none";
    });

    saveLinksButton.addEventListener("click", function (event) {
        event.preventDefault();

        const data = {
            linkedin: linkedinInput.value
        };

        if (optionalLink1Input && optionalLink1Input.value.trim() !== "") {
            data.optional_link1 = optionalLink1Input.value;
        }

        if (optionalLink2Input && optionalLink2Input.value.trim() !== "") {
            data.optional_link2 = optionalLink2Input.value;
        }

        $.ajax({
            type: 'POST',
            url: 'saveLinks.php',
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function (response) {
                alert('Links saved successfully!');

                description.textContent = editDescription.value;

                description.style.display = "block";
                editDescription.style.display = "none";

                [linkedinInput, optionalLink1Input, optionalLink2Input].forEach(input => {
                    if (input) {
                        input.setAttribute("readonly","true");
                    } else {
                        console.log("Input element not found:", input);
                    }
                });
                saveLinksButton.style.display = "none";
                editButton.style.display = "block";
            },
            error: function (error) {
                alert('Error saving links.');
            }
        });
    });
});
