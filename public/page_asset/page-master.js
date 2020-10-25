var MasterViewModel = function(data) {
    var self = this;
    self.Tours = ko.observable(data.Tours || []);
    self.Hours = ko.observable([
        { value: '00', label: '0h' },
        { value: '01', label: '1h' },
        { value: '02', label: '2h' },
        { value: '03', label: '3h' },
        { value: '04', label: '4h' },
        { value: '05', label: '5h' },
        { value: '06', label: '6h' },
        { value: '07', label: '7h' },
        { value: '08', label: '8h' },
        { value: '09', label: '9h' },
        { value: '10', label: '10h' },
        { value: '11', label: '11h' },
        { value: '12', label: '12h' },
        { value: '13', label: '13h' },
        { value: '14', label: '14h' },
        { value: '15', label: '15h' },
        { value: '16', label: '16h' },
        { value: '17', label: '17h' },
        { value: '18', label: '18h' },
        { value: '19', label: '19h' },
        { value: '20', label: '20h' },
        { value: '21', label: '21h' },
        { value: '22', label: '22h' },
        { value: '23', label: '23h' }
    ]);
    self.Minutes = ko.observable([
        { value: '00', label: "00'" },
        { value: '15', label: "15'" },
        { value: '30', label: "30'" },
        { value: '45', label: "45'" }
    ]);
    self.Cars = ko.observable(["5 chỗ", "7 chỗ", "16 chỗ"]);
    self.masterBookViewModel = new MasterBookViewModel(self);

    self.createTour = function() {
        let model = self.masterBookViewModel.toJSON();
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('#_token').val()
            }
        });

        $.ajax({
            url: data.API_URLs.CreateOrder,
            beforeSend: function() {
                NProgress.set(0.75);
            },
            type: "POST",
            data: model,
            success: function(response) {
                if (response.IsSuccess == true) {
                    alertify.success('Đặt chuyến thành công. Đã gửi email xác nhận đến địa chỉ email của bạn. Trân trọng!');
                    self.masterBookViewModel = new MasterBookViewModel(self);
                }
            },
            error: function(xhr, error) {
                let responseJSON = xhr.responseJSON;
                let commaKey = '';
                let fullErrorMsg = ''

                for (var key in responseJSON) {
                    if (responseJSON.hasOwnProperty(key)) {
                        fullErrorMsg = fullErrorMsg + commaKey + responseJSON[key][0]
                        commaKey = ', ';
                    }
                }
                alertify.error('Bạn chưa nhập/chọn: ' + fullErrorMsg);

            },
            complete: function() {
                NProgress.done();
            }
        });
    };

}

var MasterBookViewModel = function(parent) {
    var self = this;

    self.customer_name_master = ko.observable('');
    self.customer_phone_master = ko.observable('');
    self.customer_email_master = ko.observable('');

    self.no_of_passengers_master = ko.observable();
    self.pick_up_location_master = ko.observable('');
    self.pick_up_time_master = ko.observable();
    self.car_master = ko.observable('');

    self.tour_id_master = ko.observable(null);
    self.price_master = ko.observable(0);
    self.tour_title_master = ko.observable('');

    self.hour_master = ko.observable(null);
    self.minute_master = ko.observable(null);

    self.onPickupTimeChange = function() {
        self.pick_up_time_master($('#pushTime').val());
    };

    self.tour_id_master.subscribe(function(value) {
        if (value) {
            var currentTour = parent.Tours().find(x => x.id === value);
            self.price_master(currentTour ? currentTour.price : 0);
            self.tour_title_master(currentTour ? currentTour.title : '');
        } else {
            self.price_master(0);
            self.tour_title_master('');
        }
    });

    self.formatMoney = function(number) {
        var val = parseInt(number);
        return val.toFixed(0).replace(/./g, function(c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
        }) + " VNĐ";
    };

    function convertISODateString(selectedDate, hour, minute) {
        if (!hour) hour = '00';
        if (!minute) minute = '00';
        var fullDate = selectedDate + 'T' + hour + ":" + minute + "Z";
        return fullDate;
    }

    MasterBookViewModel.prototype.toJSON = function() {
        var model = {
            customer_name: ko.utils.unwrapObservable(this.customer_name_master),
            customer_phone: ko.utils.unwrapObservable(this.customer_phone_master),
            customer_email: ko.utils.unwrapObservable(this.customer_email_master),
            tour_id: ko.utils.unwrapObservable(this.tour_id_master),
            tour_title: ko.utils.unwrapObservable(this.tour_title_master),
            price: ko.utils.unwrapObservable(this.price_master),
            no_of_passengers: ko.utils.unwrapObservable(this.no_of_passengers_master),
            car_type: ko.utils.unwrapObservable(this.car_master),
            pick_up_location: ko.utils.unwrapObservable(this.pick_up_location_master),
            pick_up_time: ko.utils.unwrapObservable(convertISODateString(this.pick_up_time_master(), this.hour_master(), this.minute_master()))
        };
        return model;
    };


}