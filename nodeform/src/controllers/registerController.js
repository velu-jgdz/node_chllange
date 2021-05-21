import registerService from "../services/registerService"

let getRegisterPage = (req, res)=>{
	return res.render("register.ejs");
}

let createNewUser = async (req, res)=>{
	try {
		let data = { 
			name : req.body.name, 
			email : req.body.email, 
			password : req.body.password, 
			mobile : req.body.phone
		};
		await registerService.createNewUser(data);
		return res.status(200).json({message:"A user Created Successfully"})
	} catch(error) {
		return res.status(500).json(error);
	}
}

module.exports = {
	getRegisterPage: getRegisterPage,
	createNewUser: createNewUser
}