const chartData = {
  labels: ["Python", "Java", "JavaScript"],
  data: [70, 19, 11],
};

const myChart = document.querySelector(".my-chart");
const ul = document.querySelector(".programming-stats .details ul");

const chartInstance = new Chart(myChart, {
  type: "doughnut",
  data: {
      labels: chartData.labels,
      datasets: [{
          label: "Language Popularity",
          data: chartData.data,
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
      li.addEventListener('click', () => {
          // Toggle visibility of dataset on click
          const meta = chartInstance.getDatasetMeta(0);
          meta.data[i].hidden = !meta.data[i].hidden;
          chartInstance.update();
      });
      ul.appendChild(li);
  });
};

populateUl();