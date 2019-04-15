<template>
<div class="card m-1 col-xs-12" style="width: 20rem;">
  <img class="card-img-top" :src="image" alt="property.name">
  <div class="card-body">
    <h5 class="card-title">{{property.property_name}}</h5>
    <p class="card-text">{{property.address}}</p>
  </div>
  <div class="card-footer">
      <a :href="'book/' + property.id" class="card-link">Book Now</a>
  </div>
</div>
</template>

<script>
    export default {
        props: ['id', 'property'],
        computed: {
            image() {
                return 'https://source.unsplash.com/400x200/?resort,hotel&sig=' + this.id
            }
        },
        mounted() {
        }
    }
</script>
