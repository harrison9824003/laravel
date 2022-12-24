<template>
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="">Store</a></li>
            <li class="active">Checkout</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1>Checkout</h1>
            <!-- BEGIN CHECKOUT PAGE -->
            <div class="panel-group checkout-page accordion scrollable" id="checkout-page">

              <!-- BEGIN CHECKOUT -->
              <div id="checkout" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#checkout-content" class="accordion-toggle">
                      Step 1: Checkout Options
                    </a>
                  </h2>
                </div>
                <div id="checkout-content" class="panel-collapse collapse in">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">
                      <h3>New Customer</h3>
                      <button class="btn btn-primary" type="submit" data-toggle="collapse" data-parent="#checkout-page" data-target="#payment-address-content">Continue</button>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <h3>Returning Customer</h3>
                      <p>I am a returning customer.</p>
                      <form role="form" action="#">
                        <div class="form-group">
                          <label for="email-login">E-Mail</label>
                          <input type="text" id="email-login" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="password-login">Password</label>
                          <input type="password" id="password-login" class="form-control">
                        </div>
                        <a href="javascript:;">Forgotten Password?</a>
                        <div class="padding-top-20">                  
                          <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                        <hr>
                        <div class="login-socio">
                          <p class="text-muted">or login using:</p>
                          <ul class="social-icons">
                            <li><a href="javascript:;" data-original-title="facebook" class="facebook" title="facebook"></a></li>
                            <li><a href="javascript:;" data-original-title="Twitter" class="twitter" title="Twitter"></a></li>
                            <li><a href="javascript:;" data-original-title="Google Plus" class="googleplus" title="Google Plus"></a></li>
                            <li><a href="javascript:;" data-original-title="Linkedin" class="linkedin" title="LinkedIn"></a></li>
                          </ul>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END CHECKOUT -->

              <!-- BEGIN PAYMENT ADDRESS -->
              <div id="payment-address" class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title">
                    <a data-toggle="collapse" data-parent="#checkout-page" href="#payment-address-content" class="accordion-toggle">
                      Step 2: Account &amp; Billing Details
                    </a>
                  </h2>
                </div>
                <div id="payment-address-content" class="panel-collapse collapse">
                  <div class="panel-body row">
                    <div class="col-md-6 col-sm-6">
                      <h3>Your Personal Details</h3>
                      <div class="form-group">
                        <label for="firstname">First Name <span class="require">*</span></label>
                        <p class="firstname_error"></p>
                        <input type="text" id="firstname" v-model="firstname" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="lastname">Last Name <span class="require">*</span></label>
                        <p class="lastname_error"></p>
                        <input type="text" id="lastname" v-model="lastname" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="email">E-Mail <span class="require">*</span></label>
                        <p class="email_error"></p>
                        <input type="text" id="email" v-model="email" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="telephone">Telephone <span class="require">*</span></label>
                        <p class="telephone_error"></p>
                        <input type="text" id="telephone" v-model="telephone" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="account">account <span class="require">*</span></label>
                        <p class="account_error"></p>
                        <input type="text" id="account" v-model="account" class="form-control">
                      </div>

                      <h3>Your Password</h3>
                      <div class="form-group">
                        <label for="pwd">Password <span class="require">*</span></label>
                        <p class="pwd_error"></p>
                        <input type="password" id="pwd" v-model="pwd" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="pwd-confirm">Password Confirm <span class="require">*</span></label>
                        <p class="password_confirmation_error"></p>
                        <input type="text" id="pwd-confirm" v-model="pwd_confirmation" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <h3>Your Address</h3>
                      <!-- <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" id="company" v-model="company" class="form-control">
                      </div> -->
                      <div class="form-group">
                        <label for="address">Address</label>
                        <p class="address_error"></p>
                        <input type="text" id="address" v-model="address" class="form-control">
                      </div>
                      <!-- <div class="form-group">
                        <label for="address2">Address 2</label>
                        <input type="text" id="address2" v-model="address2" class="form-control">
                      </div> -->
                      <div class="form-group">
                        <label for="city">City</label>
                        <p class="city_error"></p>
                        <input type="text" id="city" v-model="city" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="post-code">Post Code</label>
                        <p class="postCode_error"></p>
                        <input type="text" id="post-code" v-model="postCode" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="country">Country</label>
                        <p class="country_error"></p>
                        <select class="form-control input-sm" id="country" v-model="country">
                          <option value=""> --- Please Select --- </option>
                          <option value="244">Aaland Islands</option>
                          <option value="1">Afghanistan</option>
                          <option value="2">Albania</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="region-state">Region/State</label>
                        <p class="regionState_error"></p>
                        <select class="form-control input-sm" id="region-state" v-model="regionState">
                          <option value=""> --- Please Select --- </option><option value="3513">Aberdeen</option><option value="3514">Aberdeenshire</option><option value="3515">Anglesey</option>
                        </select>
                      </div>
                    </div>
                    <hr>
                    <div class="col-md-12">                      
                      <!-- <div class="checkbox">
                        <label>
                          <input type="checkbox"> I wish to subscribe to the OXY newsletter. 
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" checked="checked"> My delivery and billing addresses are the same.
                        </label>
                      </div> -->
                      <button class="btn btn-primary  pull-right" type="submit" data-toggle="collapse" data-parent="#checkout-page" data-target="#shipping-address-content" id="button-payment-address" @click="register">Continue</button>
                      <div class="checkbox pull-right">
                        <label>
                          <input type="checkbox"> I have read and agree to the <a title="Privacy Policy" href="javascript:;">Privacy Policy</a> &nbsp;&nbsp;&nbsp; 
                        </label>
                      </div>                        
                    </div>
                  </div>
                </div>
              </div>
              <!-- END PAYMENT ADDRESS -->
            </div>
            <!-- END CHECKOUT PAGE -->
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
</template>

<script>
export default {
    mounted() {
        console.log('login mounted')
    },
    data() {
      return {
        firstname:'',
        lastname:'',
        email:'',
        telephone:'',
        account:'',
        pwd:'',
        pwd_confirmation:'',
        address:'',
        city:'',
        postCode:'',
        country:'',
        regionState:''
      }
    },
    methods: {
      register(event){
        let url = '/api/member/register'
            axios.post(url, {
              firstname: this.firstname,
              lastname: this.lastname,
              email: this.email,
              telephone: this.telephone,
              account: this.account,
              pwd: this.pwd,
              pwd_confirmation: this.pwd_confirmation,
              address: this.address,
              city: this.city,
              postCode: this.postCode,
              country: this.country,
              regionState: this.regionState,
            }).then(
                response => {
                    console.log(response.data)
                    for(var x in response.data.errors){
                      let ele = document.getElementsByClassName(x + '_error')[0];
                      ele.innerHTML = response.data.errors[x].join(',');
                    }
                },
                error => {
                    console.log(error)
                }
            )
      }
    }
}
</script>
