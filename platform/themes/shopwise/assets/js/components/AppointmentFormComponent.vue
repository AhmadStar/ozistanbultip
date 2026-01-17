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

    <!-- Step 1: Clinic / Doctor -->
    <tab-content :title="labels[lang].clinicDoctor" :selected="true">
      <div class="form-group">
        <label for="clinic">{{ labels[lang].selectClinic }}</label>
        <select
          :class="hasError('clinic') ? 'is-invalid' : ''"
          class="form-control"
          v-model="formData.clinic"
          @change="onSelectClinic($event)"
        >
          <option v-for="clinic in clinicList" :value="clinic.id" :key="clinic.id">
            {{ clinic.name }}
          </option>
        </select>
        <div v-if="hasError('clinic')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.clinic.required">
            {{ labels[lang].selectClinicError }}
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="doctor">{{ labels[lang].selectDoctor }}</label>
        <select
          :class="hasError('doctor') ? 'is-invalid' : ''"
          class="form-control"
          v-model="formData.doctor"
          @change="onSelectDoctor($event)"
        >
          <option v-for="doctor in doctorList" :value="doctor.id" :key="doctor.id">
            {{ doctor.name }}
          </option>
        </select>
        <div v-if="hasError('doctor')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.doctor.required">
            {{ labels[lang].selectDoctorError }}
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="service">{{ labels[lang].selectService }}</label>
        <select
          :class="hasError('service') ? 'is-invalid' : ''"
          class="form-control"
          v-model="formData.service"
        >
          <option v-for="service in serviceList" :value="service.id" :key="service.id">
            {{ service.name }}
          </option>
        </select>
        <div v-if="hasError('service')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.service.required">
            {{ labels[lang].selectServiceError }}
          </div>
        </div>
      </div>
    </tab-content>

    <!-- Step 2: Date / Time -->
    <tab-content :title="labels[lang].dateTime">
      <p class="danger" v-if="thisweek.length === 0">
        {{ labels[lang].noAppointments }}
      </p>

      <div class="form-group" v-if="thisweek.length !== 0">
        <label for="date">{{ labels[lang].selectDay }}</label>
        <select
          :class="hasError('date') ? 'is-invalid' : ''"
          class="form-control"
          v-model="formData.date"
          @change="onSelectDay($event)"
        >
          <option
            v-for="day in thisweek"
            :value="day.e_name"
            :key="day.e_name"
          >
            {{ lang === 'ar' ? day.a_name : day.t_name }}
          </option>
        </select>
        <div v-if="hasError('date')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.date.required">
            {{ labels[lang].selectDayError }}
          </div>
        </div>
      </div>

      <div class="form-group" v-if="dayAppointmentList.length !== 0">
        <label for="time">{{ labels[lang].selectTime }}</label>
        <select
          :class="hasError('time') ? 'is-invalid' : ''"
          class="form-control"
          v-model="formData.time"
        >
          <option v-for="time in dayAppointmentList" :value="time" :key="time">
            {{ getTimeFormat(time, lang) }}
          </option>
        </select>
        <div v-if="hasError('time')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.time.required">
            {{ labels[lang].selectTimeError }}
          </div>
        </div>
      </div>
    </tab-content>

    <!-- Step 3: Personal Info -->
    <tab-content :title="labels[lang].personalInfo">
      <div class="form-group">
        <label for="name">{{ labels[lang].name }}</label>
        <input
          type="text"
          class="form-control"
          :class="hasError('name') ? 'is-invalid' : ''"
          :placeholder="labels[lang].namePlaceholder"
          v-model="formData.name"
        />
        <div v-if="hasError('name')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.name.required">
            {{ labels[lang].nameError }}
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="phone">{{ labels[lang].phone }}</label>
        <input
          type="text"
          class="form-control"
          :class="hasError('phone') ? 'is-invalid' : ''"
          :placeholder="labels[lang].phonePlaceholder"
          v-model="formData.phone"
        />
        <div v-if="hasError('phone')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.phone.required">
            {{ labels[lang].phoneError }}
          </div>
          <div class="error" v-if="!$v.formData.phone.numeric">
            {{ labels[lang].phoneNumericError }}
          </div>
        </div>
      </div>
    </tab-content>

    <!-- Step 4: Confirm Appointment -->
    <tab-content :title="labels[lang].confirmAppointment">
      <div v-if="success">
        <p class="success">{{ labels[lang].successMessage }}</p>
        <p class="success">{{ labels[lang].successNote }}</p>
        <p class="success">{{ labels[lang].thankYou }}</p>
      </div>

      <p v-if="error" class="danger">{{ labels[lang].errorMessage }}</p>

      <div class="form-group form-check">
        <input
          type="checkbox"
          :class="hasError('terms') ? 'is-invalid' : ''"
          class="form-check-input"
          v-model="formData.terms"
        />
        <label class="form-check-label">{{ labels[lang].confirmTerms }}</label>
        <div v-if="hasError('terms')" class="invalid-feedback">
          <div class="error" v-if="!$v.formData.terms.required">
            {{ labels[lang].confirmTermsError }}
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
      thisweek: [],
      dayAppointmentList: [],
      success: false,
      error: false,
      loading: false,
      response: [],

    labels: {
      ar: {
        clinicDoctor: 'العيادة / الطبيب',
        selectClinic: 'اختر العيادة',
        selectClinicError: 'اختر العيادة',
        selectDoctor: 'اختر الطبيب',
        selectDoctorError: 'اختر الطبيب',
        selectService: 'الخدمة',
        selectServiceError: 'اختر الخدمة',
        dateTime: 'التاريخ / الوقت',
        selectDay: 'اختر اليوم',
        selectDayError: 'ادخل اليوم',
        selectTime: 'اختر التوقيت',
        selectTimeError: 'اختر التوقيت',
        personalInfo: 'المعلومات الشخصية',
        name: 'الاسم',
        namePlaceholder: 'أدخل الاسم',
        nameError: 'أدخل الاسم.',
        phone: 'الهاتف',
        phonePlaceholder: 'أدخل الهاتف',
        phoneError: 'ادخل الهاتف',
        phoneNumericError: 'يجب أن تدخل رقماً',
        confirmAppointment: 'حجز الموعد',
        confirmTerms: 'أؤكد انني اريد حجز هذا الموعد',
        confirmTermsError: 'أكد المعلومات',
        noAppointments: 'لا يتوفر مواعيد للدكتور في الأسبوع الحالي, يرجى التواصل للحصول على مزيد من المعلومات',
        successMessage: 'لقد تم حجز الموعد بنجاح',
        successNote: 'ملاحظة: الموعد المحجوز هو توقيت وصولكم لغرفة الانتظار, وليس وقت دخولكم عند الطبيب',
        thankYou: 'شكراً لكم, نتمنى لكم دوام الصحة والعافية',
        errorMessage: 'يبدو أن هناك خطأ ما يرجى المحاولة لاحقاً',
        next: 'التالي',
        previous: 'السابق',
        finish: 'biti',
      },
      tr: {
        clinicDoctor: 'Klinik / Doktor',
        selectClinic: 'Klinik seçiniz',
        selectClinicError: 'Lütfen klinik seçiniz',
        selectDoctor: 'Doktor seçiniz',
        selectDoctorError: 'Lütfen doktor seçiniz',
        selectService: 'Hizmet',
        selectServiceError: 'Lütfen hizmet seçiniz',
        dateTime: 'Tarih / Saat',
        selectDay: 'Günü seçiniz',
        selectDayError: 'Günü giriniz',
        selectTime: 'Saat seçiniz',
        selectTimeError: 'Lütfen saat seçiniz',
        personalInfo: 'Kişisel Bilgiler',
        name: 'İsim',
        namePlaceholder: 'İsminizi giriniz',
        nameError: 'İsminizi giriniz.',
        phone: 'Telefon',
        phonePlaceholder: 'Telefon numaranızı giriniz',
        phoneError: 'Telefon numaranızı giriniz',
        phoneNumericError: 'Lütfen geçerli bir sayı giriniz',
        confirmAppointment: 'Randevuyu Onayla',
        confirmTerms: 'Bu randevuyu almak istediğimi onaylıyorum',
        confirmTermsError: 'Bilgileri onaylayın',
        noAppointments: 'Bu hafta için doktor randevusu yok, lütfen iletişime geçin',
        successMessage: 'Randevu başarıyla alındı',
        successNote: 'Not: Randevu zamanı bekleme odasına varış saatinizdir, doktor yanına giriş saatiniz değildir',
        thankYou: 'Teşekkürler, sağlık ve esenlikler dileriz',
        errorMessage: 'Bir hata oluştu, lütfen tekrar deneyiniz',
        next: 'sonra',
        previous: 'onca',
        finish: 'bit',
      }
    },

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
        .get("/ajax/reservation", { params: {data: this.formData } })
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
        .get(this.url, { params: { lang: this.lang } })
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
        .get("/ajax/clinic-doctor-list", { params: { id: id ,lang: this.lang} })
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
        .get("/ajax/clinic-service-list", { params: { id: id ,lang: this.lang} })
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
        .get("/ajax/doctor-appointment-list", { params: { id: id , lang: this.lang} })
        .then((res) => {
        this.thisweek = res.data.data.data ? res.data.data.data : [];
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
        .get("/ajax/day-appointment-list", { params: { doctor_id: this.formData.doctor, day: day[0].toLowerCase(), date: day[1]} })
        .then((res) => {
          this.dayAppointmentList = res.data.data ? res.data.data : [];
          console.log(dayAppointmentList);
        })
        .catch((res) => {
        });
    },

    getTimeFormat(time) {
    // Split time "HH:MM"
    let [hourStr, minute] = time.split(':');
    let hour = parseInt(hourStr);

    let nextHour = hour + 1;
    let periodAr = '';
    let periodTr = '';

    // Determine period in Arabic
    if (hour >= 0 && hour < 12) {
        periodAr = 'صباحاً';
    } else if (hour >= 12 && hour < 17) {
        periodAr = 'ظهراً';
    } else if (hour >= 17 && hour < 19) {
        periodAr = 'عصراً';
    } else {
        periodAr = 'مساءً';
    }

    // Determine period in Turkish (just AM/PM equivalent phrasing)
    // We'll keep it simple for user understanding
    if (hour >= 0 && hour < 12) {
        periodTr = 'Sabah';
    } else if (hour >= 12 && hour < 17) {
        periodTr = 'Öğleden sonra';
    } else if (hour >= 17 && hour < 19) {
        periodTr = 'Akşamüstü';
    } else {
        periodTr = 'Akşam';
    }

    // Convert to 12-hour for label display
    let displayHour = hour % 12 === 0 ? 12 : hour % 12;
    let displayNextHour = nextHour % 12 === 0 ? 12 : nextHour % 12;

    if (this.lang === 'ar') {
        return `بين الساعة ${displayHour} و ${displayNextHour} ${periodAr}`;
    } else if (this.lang === 'tr') {
        return `Saat ${hour} ile ${nextHour} arası ${periodTr}`;
    } else {
        // fallback to original time
        return time;
    }
}


  },
};
</script>
