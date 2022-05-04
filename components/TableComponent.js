
    export default {
        emits: ['deleteRow'],
        props: {
            content: Array,
            cols: Array,
        },


        methods : {

            /*
                deleteRow function
                emits a deleteRow event with the Row ID
                to the parent function to delete the row
            */
            deleteRow(id) {           
                this.$emit('deleteRow', id);
            }
        },

        template: `
        
            <table class="table is-striped is-fullwidth">
                <thead>
                    <tr>
                       <th v-for= 'key in cols'>
                        {{ key }}
                       </th>
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

