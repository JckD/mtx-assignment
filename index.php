<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Timeline Weather API</title>
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">

</head>
<body>
 <div id="app">
    <div class="container">
        <h1 class="title">Timeline Weather API</h1>

        <div class="block">
            <form>
                <div class="columns">
                    <div class="column">
                        <label>Weather Location:</lable>
                        <input type="text" class="input is-rounded is-normal">
                    </div>
                    <div class="column" >
                        <label type="text">Start Date:</lable>
                        <input type="text" class="input is-rounded is-normal"> 
                    </div>
                    <div class="column">
                        <label>End Date:</lable>
                        <input type="text" class="input is-rounded is-normal">
                    </div>
                </div>

                <button class="button is-primary is-medium" @click="getWeather" type="button">Search</button>
            </form>
        </div>
    
        <table class="table is-striped is-fullwidth">
            <thead>
               <tr>
                <th>Date/Time</th>
                <th>Conditions</th>
                <th>Description</th>
                <th>Icon</th>
                <th>Sunrise</th>
                <th>Sunset</th>
                <th>Tempmax</th>
                <th>Tempmin</th>
                <th>Dew</th>
                <th>Humidity</th>
                <th>Pressure</th>
                <th>Windspeed</th>
                <th>Visibility</th>
            </tr> 
            </thead>
            
            <tbody>
             <tr v-for='day in weatherRes.days'>
                <td>{{ day.datetime }}</td>
                <td>{{ day.conditions }}</td>
                <td>{{ day.description }}</td>
                <td>{{ day.icon }}</td>
                <td>{{ day.sunrise }}</td>
                <td>{{ day.sunset }}</td>
                <td>{{ day.tempmax }}</td>
                <td>{{ day.tempmin }}</td>
                <td>{{ day.dew }}</td>
                <td>{{ day.humidity }}</td>
                <td>{{ day.pressure }}</td>
                <td>{{ day.windspeed }}</td>
                <td>{{ day.visibility }}</td>
            </tr> 
            </tbody>
            <!-- <tr>
                <td>{{ weatherRes.days(0) }}</td>
            </tr> -->
        </table>
    </div>
 </div>   

    

    <script>
        Vue.createApp({
            data () {
                return {
                   weatherRes : 'Search For data' 
                }
                
             },
             methods: {
                 async getWeather() {
                    
                //      fetch("https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/dublin?unitGroup=us&key=HXCDVD9QK7MSSNML24M3NP683&contentType=json", {
                //     "method": "GET",
                //     "headers": {
                //     }
                //     })
                //     .then(response => {
                //     await console.log(response.json())

                //    // console.log(this.weatherRes.json)
                //     })
                //     .catch(err => {
                //     console.error(err);
                //     });

                this.weatherRes = await( await fetch('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/dublin?unitGroup=us&key=HXCDVD9QK7MSSNML24M3NP683&contentType=json')).json()
                //console.log(await this.weatherRes)
                //console.log(await( await fetch('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/dublin?unitGroup=us&key=HXCDVD9QK7MSSNML24M3NP683&contentType=json')).json())
            }
             }

        }).mount('#app')
        
    </script>
    </style>

</body>
</html>