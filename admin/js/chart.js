const chartData = {
  labels: ["Cardiologist", "Neurologist", "Orthopedist"],
  data: [19, 70, 11],
};

const myChart = document.querySelector(".my-chart");
const ul = document.querySelector(".programming-stats .details ul");

const chartInstance = new Chart(myChart, {
  type: "doughnut",
  data: {
      labels: chartData.labels,
      datasets: [{
          label: "Departments",
          data: chartData.data,
          backgroundColor: [
            'rgb(255, 111, 97)',
            'rgb(54, 162, 235)',
            'rgb(133, 15, 15)'
          ],
      }],
  },
  options: {
      borderWidth: 10,
      borderRadius: 2,
      hoverBorderWidth: 0,
      plugins: {
          legend: {
              display: false,
          },
      },
  },
});

const populateUl = () => {
  chartData.labels.forEach((l, i) => {
      let li = document.createElement("li");
      li.innerHTML = `${l}: <span class='percentage'>${chartData.data[i]}%</span>`;
      // Toggle visibility of dataset on click
      li.addEventListener('click', () => {
          const meta = chartInstance.getDatasetMeta(0);
          meta.data[i].hidden = !meta.data[i].hidden;
          chartInstance.update();
      });
      ul.appendChild(li);
  });
};

populateUl();