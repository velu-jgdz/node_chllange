import express from "express";
import registerController from "../controllers/registerController";
import loginController from "../controllers/loginController";
import initPassportLocal from "../controllers/passportLocalController";
import homePageController from "../controllers/homePageController";

initPassportLocal();

let router = express.Router();

let initWebRoute = (app) => {
	router.get("/", loginController.checkLoggedIn, homePageController.getHomePage);
	router.post("/logout", loginController.postLogOut);

	router.get("/register", registerController.getRegisterPage);
	router.post("/register-user", registerController.createNewUser);

	router.get("/login", loginController.checkLoggedOut, loginController.getLoginPage);
	router.post("/login", loginController.verifyUser);

	router.get("/createaccount", loginController.checkLoggedIn, homePageController.createAccount);
	router.post("/accountsubmit", loginController.checkLoggedIn, homePageController.submitAccount);

	return app.use("/", router);
};

module.exports = initWebRoute;