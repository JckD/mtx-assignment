<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Timeline Weather API</title>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">

</head>
<body>
<div class="container ">
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

            <input type="button" value="Search" class="button is-primary is-medium">
        </form>
    </div>
   
    <table>
        <th></th>
    </table>
</div>
    

    <script>
        var app = new Vue({
            el: '#vueapp',
            data : {
                location : ''
            },
            // mounted: fucntion() {
            //     console.log('mounted')
            // },

            // methods: {
            //     getWeather: function() {
                    
            //     }
            // }
        })

    </script>
    <style>
        html {
            background-color: ;
        }
    </style>

</body>
</html>