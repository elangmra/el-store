@extends('layouts.auth')

@section('content')
    <div class="page-content page-auth" id="register">
      <section class="store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row align-items-center justify-content-center row-login">
            <div class="col-lg-4">
              <h2>
                  Memulai jual beli <br />
                  dengan cara baru
              </h2>
               <form method="POST" class="mt-3" action="{{ route('register') }}">
                        @csrf
                <div class="form-group">
                  <label for="">Full Name</label>                 
                  <input id="name" type="text" class="form-control @error('name') 
                        is-invalid @enderror" name="name" 
                        value="{{ old('name') }}" 
                        required v-model="name"
                        autocomplete="name" autofocus>
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="">Email Address</label>                
                  <input id="email" 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') }}" 
                        v-model="email"
                        @change="checkEmail()"
                        required autocomplete="email"
                        :class="{ 'is-invalid' : this.email_unavailable}">
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="">Password</label>
                  <input id="password" 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror"
                        name="password" 
                        required 
                        autocomplete="new-password">

                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="">Konfirmasi Password</label>
                  <input id="password-confirmation" 
                        type="password" 
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password">

                  @error('password_confirmation')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="">Store</label>
                  <p class="text-muted">Apakah anda ingin membuka toko?</p>
                  <div
                    class="custom-control custom-radio custom-control-inline"
                  >
                    <input
                      type="radio"
                      name="isStoreOpen"
                      id="openStoreTrue"
                      class="custom-control-input"
                      v-model="isStoreOpen"
                      :value="true"
                    />
                    <label for="openStoreTrue" class="custom-control-label">
                      Ya, boleh</label
                    >
                  </div>
                  <div
                    class="custom-control custom-radio custom-control-inline"
                  >
                    <input
                      type="radio"
                      name="isStoreOpen"
                      id="openStoreFalse"
                      class="custom-control-input"
                      v-model="isStoreOpen"
                      :value="false"
                    />
                    <label for="openStoreFalse" class="custom-control-label">
                      Tidak, terimakasih</label
                    >
                  </div>
                </div>
                <div class="form-group" v-if="isStoreOpen">
                  <label for="">Nama Toko</label>
                  <input type="text" 
                      class="form-control @error('store_name') is-invalid @enderror" 
                      v-model="store_name"
                      id="store_name"
                      name="store_name"
                      required
                      autocomplete
                      autofocus/>
                  @error('store_name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group" v-if="isStoreOpen">
                  <label for="">Kategori</label>
                  <select name="categories_id" class="form-control" id="">
                    <option value="" disabled>Select Category</option>
                    @foreach ($categories as  $category)
                        <option value="{{ $category->id }}" >{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
                <button
                  type="submit"
                  class="btn btn-success btn-block mt-4"
                  :disabled="this.email_unavailable"
                
                >
                  Sign Up Now</button
                >
                <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">
                  Back to Sign In</a
                >
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      Vue.use(Toasted);

      var register = new Vue({
        el: "#register",
        mounted() {
          AOS.init();        
        },
        methods: {
          checkEmail : function() { 
            var self = this;
            axios.get('{{ route('api-register-check') }}',{
              params : {
                email : this.email,
              }
            })
            .then(function (response) {
                if(response.data == 'Available'){
                  self.$toasted.show(
                    "Email tersedia", 
                    {
                    position: "top-center",
                    className: "rounded",
                    duration: 1000,
                    }
                    );
                  self.email_unavailable = false;
                }else{
                  self.$toasted.error("Maaf, tampaknya email sudah terdaftar.", {
                  position: "top-center",
                  className: "rounded",
                  duration: 1000,
                   });
                   self.email_unavailable = true;
                }
              
              // handle success
              console.log(response);
            })
          }
        },
        data() {
          return {
            name: "Elang Riefki",
            email: "elangmra@gmail.com",
            isStoreOpen: true,
            store_name: "",
            email_unavailable : false
          }
        },
      });
    </script>
@endpush