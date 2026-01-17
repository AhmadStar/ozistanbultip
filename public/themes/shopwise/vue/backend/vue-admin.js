/**
 * Created by Abdulhamid on 8/20/2021.
 */
var editorContact, editorContent;
var self;
var adminApp = new Vue({

    el: '#adminApp',

    data: {
		myHost:'',
        messages: {
            successMsg: '',
            errorMsg: '',

        },
        awRequestID: window.awRequestID,
        defaultSelecttion : [],
        selectedTime : [],
        selectedTimes : [],
    },

    created: function () {
            // `this` points to the vm instance
            self = this;
            this.getHost();
            // this.getSelecteddays();
        }

        ,

    watch: {

    },
    computed: {

    },
    methods: {
        getHost: function () {
            this.myHost = this.liveHost;
            if (location.host == 'localhost:8080' || location.host == '127.0.0.1:8080')
                this.myHost = 'http://127.0.0.1:8080/';
            if(location.host == 'localhost:8000' || location.host == '127.0.0.1:8000')
                this.myHost = 'http://127.0.0.1:8000/';
            return this.myHost;
        },

        // getSelecteddays: function () {
        //     this.selectedDays = JSON.parse($("#days").val());
        //     this.selectedDays.forEach(element => {
        //         this.defaultSelecttion.push(new Date(element+''))
        //     });
        // },

    }
});
