<template>
    <div>
        <div class="form-group mb-5">
            <label for="country" class="label text-dark">Страна {{'- '+this.countryCity.country}}</label>
            <select v-model="country" name="country" id="country" class="form-control select text-dark" @change="loadCities()">
                <option value=""></option>
                <option v-for="country in countries" :value="country.id">{{country.name}}</option>
            </select>
        </div>
        <div class="form-group mb-5">
            <label for="city" class="label text-dark">Город {{'- '+this.countryCity.city}}</label>
            <select v-model="city" name="city" id="city" class="form-control select text-dark">
                <option value=""></option>
                <option v-for="city in cities" :value="city.id">{{city.name}}</option>
            </select>
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
                countryCity: [],
            }
        },
         mounted() {
             this.loadCountries();
             this.loadCountryCity();
         },
        methods: {
            loadCountries() {
                axios.get('profile/get-countries')
                    .then(response => this.countries = response.data)
                    .catch(error => console.log(error))
            },
            loadCities() {
                axios.get(`profile/get-cities/${this.country}`)
                    .then(response => this.cities = response.data)
                    .catch(error => console.log(error))
            },
            loadCountryCity() {
                axios.get('profile/get-user-country-city')
                    .then(respsone => this.countryCity = respsone.data)
                    .catch(error => console.log(error))
            }
        }
    }
</script>
