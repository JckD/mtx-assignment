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
    <link rel="stylesheet" href="./styles/fade.css">

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
                            <input type="text" class="input is-rounded is-normal" v-model='name'  required placeholder="User Name">
                        </div>
                        <div class="column">
                            <label>Weather Location:</lable>
                            <input type="text" class="input is-rounded is-normal" v-model='location'  required placeholder="Place or lat, lon">
                        </div>
                        <div class="column" >
                            <label type="text">Date:</lable>
                            <input type="date" class="input is-rounded is-normal" v-model='startDate'  placeholder="Date"> 
                        </div>
                        <div class="column" >
                            <label type="text">API Key:</lable>
                            <input type="text" class="input is-rounded is-normal" v-model='apikey'  placeholder="API Key for TimeLine Weather API" required> 
                        </div>
                    </div>
                    <button class="button is-primary is-medium" @click="getWeather" type="button" :disabled='location == "" || location == null '>Search</button>
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
                
            </div>
            <div class="block">
                <h2 class="title is-3">Saved Weather Data</h2>
                <table-component :content="savedWeather" :cols="savedWeatherCols" @delete-row='deleteWeather'></table-copmonent>
            </div>
        </div>
    </div>     

        <script type="module">
            import TableComponent from './components/TableComponent.js'

            Vue.createApp({
                components: {
                    TableComponent
                },
                data () {
                    return {
                        weatherRes : 'Search For data',
                        name : '',
                        location: '',
                        startDate: '',
                        apikey : '',
                        savedWeather: [],
                        savedWeatherCols : ['UserName', 'DateSaved', 'Lat,Lon', 'Date/Time', 'Conditions', 'Desc', 'Icon', 'Sunrise', 'Sunset','Tmax','Tmin','Dew','Humidity','Pressure','Winspeed','Vis','Del']
                    }        
                },

                mounted: function () {
                    //Get previously saved weather
                    this.getSavedWeather()
                    //Get today's date to fill the date field by default
                    this.getToday()
                },

                methods: {

                    /*
                        getWeather function
                        Fetches weather information from Timeline Weather API
                        Takes this.location, this.startDate and this.apikey for the fetch url
                        Gets the JSON response and set's it to this.weatherRes 
                    */
                    async getWeather() {
                        this.weatherRes = await( await fetch('https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/' + this.location +'/' + this.startDate + '/?unitGroup=uk&key='+ this.apikey + '&contentType=json')).json() 
                    },


                    /*
                        getToday function
                        Called when component is mounted to create a new date Obj
                        creates correct string format for yyy-mm-dd
                        sets result to this.startdate
                    
                    */
                    getToday(){
                        let today = new Date()

                        this.startDate = today.getFullYear()+'-'+'0'+(today.getMonth()+1)+'-'+'0'+today.getDate();
                        //this.endDate = today.getFullYear()+'-'+'0'+(today.getMonth()+1)+'-'+'0'+today.getDate();
                    },

                    /*
                        getSavedWeather function
                        Queries the PHP api to get the saved weather data in the MySQL DB
                        saves the response data to this.saved weather
                    */
                    async getSavedWeather() {
                        let response = await axios.get('api/weather.php')
                        this.savedWeather = response.data
                    },

                    /*
                        deleteWeather function
                        called on button press for each row
                        using the ID in the delete request url
                        then updates the table by calling this.getSavedWeather()
                    */
                    deleteWeather(id) {

                        axios.delete('api/weather.php/?id='+id)
                        .then((res)=> {this.getSavedWeather()});
                    },

                    /*
                        addWeather function
                        Creates a new form Obj and appends all the user input
                        and weather data that the user wants to save
                        then sends a post request to the PHP API and
                        calls this.getSavedWeather() to update the table component
                    */
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

                        axios({
                            method:'post',
                            url: 'api/weather.php',
                            data: formData,
                            config : { headers: {'Content-Type': 'multipart/form-data'}}
                        })
                        .then((response) =>{
                            this.getSavedWeather()
                        }).catch(function(error) {
                            console.log(error)
                        })        
                    }
                }
            }).mount('#app')
        </script>
    </body>
</html>