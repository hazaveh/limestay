window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('property', require('./components/Property.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#bookingapp',
    data: {
        locationAccess: false,
        accommodations: [],
        locationError: '',
        lat: "",
        lng: ""
    },
    methods: {
        getLocation: function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(this.onLocation, this.onLocationError);
            } else {
                this.locationError = "This Device Doesn't Support GeoLocation."
            }
        },
        onLocation: function (location) {
            this.lat = location.coords.latitude
            this.lng = location.coords.longitude
            this.search();
            
        },
        onLocationError: function (error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                  this.locationError = "Permission to Location Services is Denied, Please Allow LimeStay to Access Your Device Location."
                  break;
                case error.POSITION_UNAVAILABLE:
                  this.locationError = "Location information is unavailable."
                  break;
                case error.TIMEOUT:
                  this.locationError = "The request to get user location timed out."
                  break;
                case error.UNKNOWN_ERROR:
                  this.locationError = "An unknown error occurred."
                  break;
              }
        },
        search: function() {
            axios.get('/nearby?lat=' + this.lat + '&lng=' + this.lng).then(function(res){
                this.accommodations = res.data
            }.bind(this)).catch(function(err){
                this.locationError = err
            }.bind(this));
        }
    },
    mounted: function() {
        this.getLocation()
    },
});
