
    export default {
        emits: ['deleteRow'],
        props: {
            content: Array,
            
        },

        

        data () {
            return {
              
            }
        },

        methods : {
            deleteRow(id) {

                // axios.delete('api/weather.php/?id='+id)
                // .then((res)=> {this.getSavedWeather()});
                
                this.$emit('deleteRow', id);
            }
        },

        template: `
        
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
                    <tr v-for='item in content'>
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
                        <td><button class="button is-danger" @click="deleteRow(item.id)">Del</button></td>
                    </tr> 
                </tbody>
            </table>

        `
    }

