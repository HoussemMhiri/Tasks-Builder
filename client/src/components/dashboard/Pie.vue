<template>
  <div class="chart-container">
    <div
      v-if="loading"
      class="d-flex justify-content-center align-items-center"
      style="height: 100%"
    >
      <div class="spinner-border text-primary" role="status"></div>
    </div>
    <canvas v-else id="doughnutChart"></canvas>
  </div>
</template>

<script setup>
import { computed, onMounted, ref, watchEffect, nextTick } from "vue";
import { Chart, registerables } from "chart.js";
import ChartDataLabels from "chartjs-plugin-datalabels";

import axios from "../../../axiosToken";

// Register Chart.js components and the data labels plugin
Chart.register(...registerables, ChartDataLabels);

const allTasks = ref([]);
let doughnutChart = null;
const loading = ref(true);

const getAllTasks = async () => {
  try {
    const { data } = await axios.get("api/tasks");
    allTasks.value = data.tasks;
    console.log("All Tasks Fetched:", allTasks.value);
  } catch (error) {
    console.error("Error fetching tasks:", error);
  } finally {
    loading.value = false;
  }
};

const uncompletedTasks = computed(() => {
  return allTasks.value.filter((el) => el.isDone === false).length;
});
const completedTasks = computed(() => {
  return allTasks.value.filter((el) => el.isDone === true).length;
});

const renderChart = async () => {
  // Ensure the canvas is ready before rendering
  await nextTick();

  const ctx = document.getElementById("doughnutChart").getContext("2d");

  if (!ctx) {
    console.error("Canvas element not found!");
    return;
  }

  // Destroy existing chart instance if it exists
  if (doughnutChart) {
    doughnutChart.destroy();
  }

  // Data for the doughnut chart
  const data = {
    labels: ["Tasks Completed", "Tasks Uncompleted"],
    datasets: [
      {
        label: "Tasks",
        data: [completedTasks.value, uncompletedTasks.value],
        backgroundColor: ["#5E72C2", "#C8D6FF"],
        borderColor: ["#5E72C2", "#C8D6FF"],
        hoverOffset: 4,
      },
    ],
  };

  // Configuration for the chart, including the data labels plugin
  const config = {
    type: "doughnut",
    data: data,
    options: {
      plugins: {
        datalabels: {
          color: "black",
          anchor: "center",
          align: "center",
          formatter: (value) => value, // Display the actual value
          font: {
            weight: "bold",
          },
        },
      },
    },
  };

  // Initialize the chart and assign it to the doughnutChart variable
  doughnutChart = new Chart(ctx, config);
};

// Watch for changes in task counts and render the chart
watchEffect(async () => {
  if (allTasks.value.length > 0 && !loading.value) {
    await renderChart();
  }
});

onMounted(() => {
  getAllTasks();
});
</script>

<style scoped>
.chart-container {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  background-color: white;
  box-shadow: 0 2px 4px #5e72c2;
  border-radius: 5px;
}

#doughnutChart {
  width: 80%;
  margin-bottom: 10px;
}
</style>
