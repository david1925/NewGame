function User()
{
    this.id;
    this.username;
    this.name;
    this.firstname;
    this.lastname;
    this.email;
    this.phone;
    this.image;
    this.summary;
    this.address;
    this.profile;
    this.status;
    this.language;

    this.construct = function (id, username, name, firstname, lastname, email, phone, image, summary, address, profile, status, language)
    {
        this.setId(id);
        this.setUsername(username);
        this.setName(name);
		this.setFirstname(firstname);
		this.setLastname(lastname);
        this.setEmail(email);
        this.setPhone(phone);
        this.setImage(image);
        this.setSummary(summary);
        this.setAddress(address);
        this.setProfile(profile);
        this.setStatus(status);
        this.setLanguage(language);
    }

    //Setters
    this.setId = function (id) {this.id=id;}
    this.setUsername = function (username) {this.username=username;}
    this.setName = function (name) {this.name=name;}
    this.setFirstname = function (firstname) {this.firstname=firstname;}
    this.setLastname = function (lastname) {this.lastname=lastname;}
    this.setEmail = function (email) {this.email=email;}
    this.setPhone = function (phone) {this.phone=phone;}
    this.setImage = function (image) {this.image=image;}
    this.setSummary = function (summary) {this.summary=summary;}
    this.setAddress = function (address) {this.address=address;}
    this.setProfile = function (profile) {this.profile=profile;}
    this.setStatus = function (status) {this.status=status;}
    this.setLanguage = function (language) {this.language=language;}

    //Getters
    this.getId = function () {return this.id;}
    this.getUsername = function () {return this.username;}
    this.getName = function () {return this.name;}
    this.getFirstname = function () {return this.firstname;}
    this.getLastname = function () {return this.lastname;}
    this.getEmail = function () {return this.email;}
    this.getPhone = function () {return this.phone;}
    this.getImage = function () {return this.image;}
    this.getSummary = function () {return this.summary;}
    this.getAddress = function () {return this.address;}
    this.getProfile = function () {return this.profile;}
    this.getStatus = function () {return this.status;}
    this.getLanguage = function () {return this.language;}
}
