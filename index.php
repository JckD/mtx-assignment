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
        <h1 class="title is-2">Timeline Weather API</h1>
        
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
                    <div class="column" >
                        <label type="text">API Key:</lable>
                        <input type="text" class="input is-rounded is-normal" v-model='apikey' @change='setApikey' placeholder="API Key for TimeLine Weather API" required> 
                    </div>

                </div>

                <button class="button is-primary is-medium" @click="getWeather" type="button" :disabled='location == " " || location == null '>Search</button>
            </form>
        </div>
        <div class="block">
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
            <button class="button is-primary is-medium" @click="addWeather" type="button">Save Weather Data</button>
            <br/>
            <!-- <button class="button is-primary is-medium" @click="getSavedWeather" type="button">Save Weather Data</button> -->


        </div>
        
        <div class="block">
            <h2 class="title is-3">Saved Weather Data</h2>
            <table class="table is-striped is-fullwidth">
                <thead>
                    <tr>
                        <th>UserName</th>
                        <th>DateSaved</th>
                        <th>Lat,Lon</th>
                        <th>Date/Time</th>
                        <th>Conditions</th>
                        <th>Desc</th>
                        <th>Icon</th>
                        <th>Sunrise</th>
                        <th>Sunset</th>
                        <th>Tmax</th>
                        <th>Tmin</th>
                        <th>Dew</th>
                        <th>Humidity</th>
                        <th>Pressure</th>
                        <th>Windspeed</th>
                        <th>Vis</th>
                        <th>Del</th>
                    </tr> 
                </thead>

                <tbody>
                    <tr v-for='item in savedWeather'>
                        <td>{{ item.UserName }}</td>
                        <td>{{ item.SpecifiedDate }}</td>
                        <td>{{ item.LatLon }}</td>
                        <td>{{ item.ResDateTime }}</td>
                        <td>{{ item.ResConditions }}</td>
                        <td>{{ item.ResDescription }}</td>
                        <td>{{ item.ResIcon }}</td>
                        <td>{{ item.ResSunrise }}</td>
                        <td>{{ item.ResSunset }}</td>
                        <td>{{ item.ResTempmax }}</td>
                        <td>{{ item.ResTempmin }}</td>
                        <td>{{ item.ResDew }}</td>
                        <td>{{ item.ResHumidity }}</td>
                        <td>{{ item.ResPressure }}</td>
                        <td>{{ item.ResWindspeed }}</td>
                        <td>{{ item.ResVisibility }}</td>
                        <td><button class="button is-danger" @click="deleteWeather(item.id)">Del</button></td>
                    </tr> 
                </tbody>
            </table>
        </div>
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
                   apikey : null,
                   savedWeather: null,

                }
                
             },

             mounted: function () {
                this.getSavedWeather()
                 console.log(this.savedWeather)
                this.getToday()
             },




             watch() {

             },

             methods: {
                 async getWeather() {
                    
                    this.weatherRes = await( await fetch('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/' + this.location +'/' + this.startDate + '/?unitGroup=uk&key='+ this.apikey + '&contentType=json')).json()
                },

                setLocation(e) {
                    this.location = e.target.value
                    console.log(this.savedWeather)
                },

                setStartDate(e) {
                    this.startDate = e.target.value
                },

                setApikey(e) {
                    this.apikey = e.target.value
                },

                getToday(){
                    let today = new Date()

                    this.startDate = today.getFullYear()+'-'+'0'+(today.getMonth()+1)+'-'+'0'+today.getDate();
                    this.endDate = today.getFullYear()+'-'+'0'+(today.getMonth()+1)+'-'+'0'+today.getDate();

                },

                async getSavedWeather() {
                    response = await axios.get('api/weather.php')
                    this.savedWeather = response.data
                   console.log(this.savedWeather)
                },

                deleteWeather(id) {

                    axios.delete('api/weather.php/?id='+id);
                },

                addWeather() {

                    let formData = new FormData();

                    formData.append('UserName', this.name)
                    formData.append('SpecifiedDate', this.startDate)
                    formData.append('LatLon', this.location)
                    formData.append('ResDateTime', this.weatherRes.days[0].datetime)
                    formData.append('ResConditions', this.weatherRes.days[0].conditions)
                    formData.append('ResDescription', this.weatherRes.days[0].description)
                    formData.append('ResIcon', this.weatherRes.days[0].icon)
                    formData.append('ResSunrise', this.weatherRes.days[0].sunrise)
                    formData.append('ResSunset', this.weatherRes.days[0].sunset)
                    formData.append('ResTempmax', this.weatherRes.days[0].tempmax)
                    formData.append('ResTempmin', this.weatherRes.days[0].tempmin)
                    formData.append('ResDew', this.weatherRes.days[0].dew)
                    formData.append('ResHumidity', this.weatherRes.days[0].humidity)
                    formData.append('ResPressure', this.weatherRes.days[0].pressure)
                    formData.append('ResWindspeed', this.weatherRes.days[0].windspeed)
                    formData.append('ResVisibility', this.weatherRes.days[0].visibility)

                    console.log(formData)
                    let weatherData = {};
                    formData.forEach(function(value, key){
                        weatherData[key] = value;
                    })

                    axios({
                        method:'post',
                        url: 'api/weather.php',
                        data: formData,
                        config : { headers: {'Content-Type': 'multipart/form-data'}}
                    })
                    .then(function (response) {
                        console.log(response)
                    }).catch(function(error) {
                        console.log(response)
                    })
                    
                }



            }

        }).mount('#app')
        
    </script>
    </style>

</body>
</html>