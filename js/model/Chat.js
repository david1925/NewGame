function Chat() {
    this.idUser;
    this.text;

    this.construct = function (idUser, text) {
        this.setIdUser(idUser);
        this.setText(text);
    }

    this.getIdUser = function () {return this.idUser;}
    this.getText = function () {return this.text;}

    this.setIdUser = function (idUser) {this.idUser=idUser;}
    this.setText = function (text) {this.text=text;}
}