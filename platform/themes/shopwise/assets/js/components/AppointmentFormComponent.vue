<style scoped>
.loader{  /* Loader Div Class */
    position: absolute;
    top:0px;
    right:0px;
    width:100%;
    height:100%;
    background-color:#b04040;
    background-image: url('../themes/shopwise/images/ajax-loader.gif');
    background-size: 50px;
    background-repeat:no-repeat;
    background-position:center;
    z-index:10000000;
    opacity: 0.2;
    filter: alpha(opacity=40);
}

.success{
    text-align: center;
    font-weight: bold;
    color: green;
}

.danger{
    text-align: center;
    font-weight: bold;
    color: red;
}

</style>

<template>
  <form-wizard @onComplete="onComplete" id="axiosForm">


    <div class="loader" v-if="loading"></div>
    <!-- <div class="loader" v-if="loading"></div> -->
    <tab-content title="العيادة / الطبيب" :selected="true">
      <div class="form-group">
        <label for="clinic">العيادة</label>
        <select
          :class="hasError('clinic') ? 'is-invalid' : ''"
          class="form-control"
          v-model="formData.clinic"
          @change="onSelectClinic($event)"
        >
          <option v-for="clinic in clinicList" :value="clinic.id">
            {{ clinic.name }}
          </option>
        </select>
        <div v-if="hasError('clinic')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.clinic.required">
             اختر العيادة
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="doctor">الطبيب</label>
        <select
          :class="hasError('doctor') ? 'is-invalid' : ''"
          class="form-control"
          v-model="formData.doctor"
          @change="onSelectDoctor($event)"
        >
          <option v-for="doctor in doctorList" :value="doctor.id">
            {{ doctor.name }}
          </option>
        </select>
        <div v-if="hasError('doctor')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.doctor.required">
             اختر الطبيب
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="service">الخدمة</label>
        <select
          :class="hasError('service') ? 'is-invalid' : ''"
          class="form-control"
          v-model="formData.service"
        >
          <option v-for="service in serviceList" :value="service.id">
            {{ service.name }}
          </option>
        </select>
        <div v-if="hasError('service')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.service.required">
             اختر الخدمة
          </div>
        </div>
      </div>
    </tab-content>
    <tab-content title="التاريخ / الوقت">

      <p class="danger" v-if="thisweek.length  == 0" >لا يتوفر مواعيد للدكتور في الأسبوع الحالي, يرجى التواصل للحصول على مزيد من المعلومات</p>

        <div class="form-group" v-if="thisweek.length  != 0">
        <label for="date"> اختر اليوم</label>
        <select
          :class="hasError('date') ? 'is-invalid' : ''"
          class="form-control"
          v-model="formData.date"
          @change="onSelectDay($event)"
        >

          <option v-for="date in thisweek" :value="date.e_name">
            {{ date.a_name }}
          </option>
        </select>
        <div v-if="hasError('date')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.date.required">
             ادخل اليوم
          </div>
        </div>
      </div>

      <!-- <p class="danger" v-if="dayAppointmentList.length  == 0 && this.formData.date">يرجى اختيار يوم آخر لا يوجد مواعيد متوفرة في هذا اليوم</p> -->

      <div class="form-group" v-if="dayAppointmentList.length  != 0">
        <label for="time"> اختر التوقيت</label>
        <select
          :class="hasError('time') ? 'is-invalid' : ''"
          class="form-control"
          v-model="formData.time"
        >
          <option v-for="time in dayAppointmentList" :value="time">
            {{ getTimeFormat(time) }}
          </option>
        </select>
        <div v-if="hasError('time')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.time.required">
             اختر التوقيت
          </div>
        </div>
      </div>



    </tab-content>
    <tab-content title="المعلومات الشخصية">
      <div class="form-group">
        <label for="name">{{ __("الاسم") }}</label>
        <input
          type="text"
          class="form-control"
          :class="hasError('name') ? 'is-invalid' : ''"
          placeholder="أدخل الاسم"
          v-model="formData.name"
        />
        <div v-if="hasError('name')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.name.required">
            {{ __("أدخل الاسم.") }}
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="phone">{{ __("الهاتف") }}</label>
        <input
          type="text"
          class="form-control"
          :class="hasError('phone') ? 'is-invalid' : ''"
          placeholder="أدخل الهاتف"
          v-model="formData.phone"
        />
        <div v-if="hasError('phone')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.phone.required">
            ادخل الهاتف
          </div>
          <div class="error" v-if="!$v.formData.phone.numeric">
            يحب ان تدخل رقماً
          </div>
        </div>
      </div>
    </tab-content>
    <tab-content title="حجز الموعد">

        <div v-if="success">
            <p  class="success">لقد تم حجز الموعد بنجاح</p>
            <p  class="success">ملاحظة: الموعد المحجوز هو توقيت وصلولكم لغرفة الانتظار, وليس وقت دخولكم لعند الطبيب</p>
            <p  class="success">شكراً لكم, نتمنا لكم دوام الصحة والعافية</p>
        </div>


        <p v-if="error" class="danger">يبدو أن هناك خطأ ما يرجى المحاولة لاحقاً</p>

      <div class="form-group form-check">
        <input
          type="checkbox"
          :class="hasError('terms') ? 'is-invalid' : ''"
          class="form-check-input"
          v-model="formData.terms"
        />
        <label class="form-check-label">أؤكد انني اريد حجز هذا الموعد</label>
        <div v-if="hasError('terms')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.terms.required">
             أكد المعلومات
          </div>
        </div>
      </div>
    </tab-content>
  </form-wizard>
</template>

  <script>
import { FormWizard, TabContent, ValidationHelper } from "vue-step-wizard";
import "vue-step-wizard/dist/vue-step-wizard.css";
import { required } from "vuelidate/lib/validators";
import { email } from "vuelidate/lib/validators";
import { numeric } from "vuelidate/lib/validators";
import dayjs from "dayjs";

export default {
  name: "StepFormValidation",
  components: {
    FormWizard,
    TabContent,
  },
  mixins: [ValidationHelper],
  data() {
    return {
      clinicList: [],
      doctorList: [],
      serviceList: [],
      thisweek: [
      ],
      dayAppointmentList: [],
      success: false,
      error: false,
      loading: false,
      response: [],

      formData: {
        doctor: "",
        service: "",
        clinic: "",
        time: "",
        date: "",
        email: null,
        name: null,
        phone: null,
      },
      validationRules: [
        { doctor: { required }, service: { required }, clinic: { required } },
        { date: { required }, time: { required } },
        { name: { required }, phone: { required, numeric } },
        { terms: { required } },
      ],
    };
  },

  props: {
    url: {
      type: String,
      default: () => null,
      required: true,
    },
    lang: {
        type: String,
        required: true,
        default: 'ar', // fallback language
    },
  },

  mounted() {
    this.getClinicList();
    console.log('Current language:', this.lang);
  },

  methods: {
    addDays(days) {
      let newDate = new Date(new Date());
      newDate.setDate(new Date().getDate() + days);
      return dayjs(newDate).format("dddd MM-D-YYYY");
    },

    arabic(day) {
        var day = day.split(' ');
        switch(day[0]){
            case 'Saturday':
                return 'السبت '+ day[1];
                break;
            case 'Sunday':
                return 'الأحد '+ day[1];
                break;
            case 'Monday':
                return 'الاثنين '+ day[1];
                break;
            case 'Tuesday':
                return 'الثلاثاء '+ day[1];
                break;
            case 'Wednesday':
                return 'الأربعاء '+ day[1];
                break;
            case 'Thursday':
                return 'الخميس '+ day[1];
                break;
            case 'Friday':
                return 'الجمعة '+ day[1];
                break;
            default:
                return 'test'
        }
    },

    onComplete() {
      this.loading = true,
      axios
        .get("ajax/reservation", { params: {data: this.formData } })
        .then((res) => {
          this.response = res.data.data ? res.data.data : [];
          this.success = true;
          setTimeout(() => this.reset(), 8000);
        })
        .catch((res) => {
          this.error = true;
          setTimeout(() => this.reset(), 8000);

        }).finally(() => {
            this.loading = false;
        });
    },

    reset(){
        this.success = false;
        this.error = false;
        this.isLoading = false;

        location.href = "/";

    },

    getClinicList() {
      this.clinicList = [];
      axios
        .get(this.url)
        .then((res) => {
          this.clinicList = res.data.data ? res.data.data : [];
        })
        .catch((res) => {
          this.isLoading = false;
        });
    },

    getClinicDoctorList(id) {
      this.doctorList = [];
      axios
        .get("ajax/clinic-doctor-list", { params: { id: id } })
        .then((res) => {
          this.doctorList = res.data.data ? res.data.data : [];
        })
        .catch((res) => {
        });
    },

    getClinicServices(id) {
      this.serviceList = [];
      this.thisweek = [];
      this.doctor = '';
      this.dayAppointmentList = [];
      axios
        .get("ajax/clinic-service-list", { params: { id: id } })
        .then((res) => {
          this.serviceList = res.data.data ? res.data.data : [];
        })
        .catch((res) => {
        });
    },

    onSelectClinic(event) {
      this.getClinicDoctorList(event.target.value);
      this.getClinicServices(event.target.value);
    },

    onSelectDoctor(event) {
      this.getDoctorAppointmentList(event.target.value);
    },

    getDoctorAppointmentList(id) {
      this.thisweek = [];
      this.dayAppointmentList = [];

      axios
        .get("ajax/doctor-appointment-list", { params: { id: id } })
        .then((res) => {
          this.thisweek = res.data.data ? res.data.data : [];
        })
        .catch((res) => {
        });
    },

    onSelectDay(event) {
      this.dayAppointmentList = [];
      this.formData.time = '';
      this.getDayAppointmentList(event.target.value);
    },

    getDayAppointmentList(day) {
      var day = day.split(' ');
      this.dayAppointmentList = [];
      axios
        .get("ajax/day-appointment-list", { params: { doctor_id: this.formData.doctor, day: day[0].toLowerCase(), date: day[1] } })
        .then((res) => {
          this.dayAppointmentList = res.data.data ? res.data.data : [];
        //   this.getTimeFormat();
        })
        .catch((res) => {
        });
    },

    getTimeFormat(time) {
        // use of explode
        var str_arr = time.split(':');
        switch(str_arr[0]){
            case '12' :
                return time+' ظهراً';
            break;
            case '13' :
                return '01:'+str_arr[1]+' ظهراً';
            break;
            case '14' :
                return '02:'+str_arr[1]+' ظهراً';
            break;
            case '15' :
                return '03:'+str_arr[1]+' ظهراً';
            break;
            case '16' :
                return '04:'+str_arr[1]+' عصراً';
            break;
            case '17' :
                return '05:'+str_arr[1]+' عصراً';
            break;
            case '18' :
                return '06:'+str_arr[1]+' عصراً';
            break;
            case '19' :
                return '07:'+str_arr[1]+' مساءً';
            break;
            case '20' :
                return '08:'+str_arr[1]+' مساءً';
            break;
            case '21' :
                return '09:'+str_arr[1]+' مساءً';
            break;
            case '22' :
                return '10:'+str_arr[1]+' مساءً';
            break;
            case '23' :
                return '11:'+str_arr[1]+' مساءً';
            break;
            default :
                return time+' صباحاً';
            break;
        }
    },

  },
};
</script>
