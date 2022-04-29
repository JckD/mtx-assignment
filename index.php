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
                        <label>Name:</lable>
                        <input type="text" class="input is-rounded is-normal" v-model='name' @change='setName' required placeholder="User Name">
                    </div>
                    <div class="column">
                        <label>Weather Location:</lable>
                        <input type="text" class="input is-rounded is-normal" v-model='location' @change='setLocation' required placeholder="Place or lat, lon">
                    </div>
                    <div class="column" >
                        <label type="text">Date:</lable>
                        <input type="date" class="input is-rounded is-normal" v-model='startDate' @change='setStartDate' placeholder="Date"> 
                    </div>

                </div>

                <button class="button is-primary is-medium" @click="getWeather" type="button" :disabled='location == " " || location == null '>Search</button>
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

        </table>
    </div>
 </div>   

    

    <script>
        Vue.createApp({
            data () {
                return {
                   weatherRes : 'Search For data',
                   name : null,
                   location: null,
                   startDate: null,
                }
                
             },

             created() {
                 this.getToday()
             },

             methods: {
                 async getWeather() {
                    
                    this.weatherRes = await( await fetch('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/' + this.location +'/' + this.startDate + '/?unitGroup=uk&key=HXCDVD9QK7MSSNML24M3NP683&contentType=json')).json()
                },

                setLocation(e) {
                    this.location = e.target.value
                    console.log(this.location)
                },

                setStartDate(e) {
                    this.startDate = e.target.value
                },



                getToday(){
                    let today = new Date()

                    this.startDate = today.getFullYear()+'-'+'0'+(today.getMonth()+1)+'-'+today.getDate();
                    this.endDate = today.getFullYear()+'-'+'0'+(today.getMonth()+1)+'-'+today.getDate();

                }


            }

        }).mount('#app')
        
    </script>
    </style>

</body>
</html>