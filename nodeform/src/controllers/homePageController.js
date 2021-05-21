import accountService from "../services/accountService"

let getHomePage = (req, res) => {
	return res.render("homepage.ejs", {
		user: req.user
	})
};

let createAccount = (req, res) => {
	return res.render("createaccount.ejs", {
		user: req.user
	})
};


let submitAccount = async (req, res) => {
	try {
		let data = { 
			user_id: req.user.id,
			account_number : req.body.account, 
			balance : req.body.deposit
		};
		await accountService.createNewAccount(data);
		return res.status(200).json({message:"Account Created Successfully"})
	} catch(error) {
		return res.status(500).json(error);
	}
}

module.exports = {
	getHomePage: getHomePage,
	createAccount: createAccount,
	submitAccount: submitAccount
};