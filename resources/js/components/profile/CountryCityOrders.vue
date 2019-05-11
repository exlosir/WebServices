<template>
    <div class="row">
        <div class="col-sm col-lg">
            <div class="form-group mb-4">
                <label class="label text-dark">Страна <sup><i class="fa fa-asterisk text-danger"></i></sup></label>
                <select v-model="country" class="form-control select text-dark" name="country" @change="loadCities()">
                    <option value=""></option>
                    <option v-for="country in countries" :value="country.id">{{country.name}}</option>
                </select>
            </div>
        </div>
        <div class="col-sm col-lg">
            <div class="form-group mb-4">
                <label class="label text-dark">Город <sup><i class="fa fa-asterisk text-danger"></i></sup></label>
                <select v-model="city" class="form-control select text-dark" name="city">
                    <option value=""></option>
                    <option v-for="cit in cities" :value="cit.id">{{cit.name}}</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
     export default {
        data() {
            return {
                countries: [],
                cities: [],
                country: '',
                city: '',
            }
        },
         mounted() {
             this.loadCountries();
         },
        methods: {
            loadCountries() {
                axios.get('/profile/get-countries')
                    .then(response => this.countries = response.data)
                    .catch(error => console.log(error))
            },
            loadCities() {
                axios.get(`/profile/get-cities/${this.country}`)
                    .then(response => this.cities = response.data)
                    .catch(error => console.log(error))
            }
        }
    }
</script>
