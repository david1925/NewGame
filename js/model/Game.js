function Game() {
    this.idGame;
    this.name;
    this.description;
    this.price;
    this.publicationDate;
    this.urlImage;
    this.rating;
    this.idGender;

    this.construct = function (idGame, name, price, urlImage, rating, idGender) {
        this.setIdGame(idGame);
        this.setName(name);
        this.setPrice(price);
        this.setUrlImage(urlImage);
        this.setRating(rating);
        this.setIdGender(idGender);
    }

    //Setters
    this.setIdGame = function (idGame) {this.idGame=idGame;}
    this.setName = function (name) {this.name=name;}
    this.setDescription = function (description) {this.description=description;}
    this.setPrice = function (price) {this.price=price;}
    this.setPublicationDate = function (publicationDate) {this.publicationDate=publicationDate;}
    this.setUrlImage = function (urlImage) {this.urlImage=urlImage;}
    this.setRating = function (rating) {this.rating=rating;}
    this.setIdGender = function (idGender) {this.idGender=idGender;}

    //Getters
    this.getIdGame = function () {return this.idGame;}
    this.getName = function () {return this.name;}
    this.getDescription = function () {return this.description;}
    this.getPrice = function () {return this.price;}
    this.getPublicationDate = function () {return this.publicationDate;}
    this.getUrlImage = function () {return this.urlImage;}
    this.getRating = function () {return this.rating;}
    this.getGender = function () {return this.idGender;}
    this.setGenreRequests = function (genreRequests){this.genreRequests=genreRequests;}

    //ADO
    this.addGenreRequests = function (genreReq) {
        this.genreRequests.push(genreReq);
    }

    this.removeGenreRequests = function (genreReq) {
        for (var i = 0; i < this.getGenreRequests().length; i++) {
            if(this.getGenreRequests()[i]==genreReq) {
                this.genreRequests.splice(i,1);
                break;
            }
        }
    }
}
