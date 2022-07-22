$(".counter-up").counterUp({
    delay:10,
    time:1000,
});

let dateArr=["jul 21","jul 20","jul 19","jul 18","jul 17","jul 16","jul 15","jul 14","jul 13","jul 12","jul 11"];
let orderCounterArr=[7,5,6,4,6,4,8,6,8,9,6]
let viewcounter = [13,12,15,14,20,17,19,16,23,33,16];

let ctx = document.getElementById('ov').getContext('2d');

$(function(){
    let myChart = new Chart(ctx,{
        type: 'line',
        data: {
            labels: dateArr,
            datasets: [{
                label:'Order',
                data: orderCounterArr,
                backgroundColor: [
                   " #0d6efd30",
                ],
                borderColor: [
                   "#0d6efd30",
                ],
                borderWidth: 2,
                tension:0,
                fill:false,
                borderColor: '#0d6efd30',
                animations: {
                    borderColor: {
                        type:"color",
                      duration: 1000,
                      easing: 'linear',
                      from: "green",
                      to: "red",
                      loop: true
                    }
                  },
            },
            {
                label:'view',
                data: viewcounter,
                backgroundColor: [
                   " #198754",
                ],
                borderColor: [
                   "#198754",
                ],
                borderWidth: 1,
                tension:0,
                fill:false,
                borderColor: '#198754',
            }]
        },
        options: {
             scales: {
                yAxes:[{
                    display:false,
                    ticks:{
                        beginAtZero: true,
                    }
                }],
                xAxes: [{
                    display: false,
                    gridLines: false,
                }]
                
            },
            animations: {
                tension: {
                  duration: 1000,
                  easing: 'linear',
                  from: 1,
                  to: 5,
                  loop: true
                }
              },
            legend:{
                labels:{
                    usePointStyle:true,
                }
            },
          
            
        }
    });
   
})



let orderfromplace=[5,15,4,9,7];
let places = ["YGN","MDY","NPT","SHAN","MEW"]

const op= document.getElementById('op').getContext('2d');
$(function(){
    let myChart = new Chart(op, {
        type: 'doughnut',
        data: {
            labels: places,
            datasets: [{
                label: '# of Votes',
                data: orderfromplace,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes:[{
                    display:false,
                }],
                xAxes:[{
                    display:false,
                }],
                y: {
                    beginAtZero: true
                }
            },
            legend:{
                position:"bottom",
                label:{
                usePointStyle:true,
            }
                }
        }
    });
})