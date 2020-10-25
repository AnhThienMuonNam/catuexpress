function FormViewModel(data) {
    var self = this;
    self.Users = ko.observableArray(data.Users || []);
    self.Cities = ko.observableArray(data.Cities || []);

    self.Keyword = ko.observable(null);
    self.CityId = ko.observable(null);
    self.IsAdmin = ko.observable(null);

    self.search = function() {
       $.ajaxSetup({
            headers: {'X-CSRF-Token': $('#_token').val()}
        });
        $.ajax({
            url: data.API_URLs.SearchUser,
            type: "POST",
            data: {
                    Keyword : self.Keyword(),
                    CityId : self.CityId(),
                    IsAdmin : self.IsAdmin(),
                    },
            success: function(response){
                if(response){
                    self.Users(response.Users);
                }
            },
            error: function(xhr, error){
                console.log(xhr.responseText);
            },
        });
    };
}
