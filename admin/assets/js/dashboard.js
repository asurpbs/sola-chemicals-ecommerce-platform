// Example for rendering charts
const ctx = document.getElementById('trafficChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
        datasets: [{
            label: 'Website Traffic',
            data: [100, 200, 150, 250, 300],
            borderColor: 'rgba(75, 192, 192, 1)',
            tension: 0.1
        }]
    }
});
