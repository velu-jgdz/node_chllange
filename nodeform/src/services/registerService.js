import connection from "../config/connectDB";
import bcrypt from "bcryptjs";

let createNewUser = (user)=>{
	return new Promise((resolve, reject)=>{
		try{
			let check = checkEmailUser(user.email);
			if(!check)
			{
				let salt = bcrypt.genSaltSync(10);
				let data = {
					name :user.name,
					email:user.email,
					password: bcrypt.hashSync(user.password, salt),
					mobile:user.mobile
				};

				connection.query("INSERT INTO users set ?", data, function(error, rows){
					if(error) reject(error);
					resolve("create a  new user succesfully");
				});
			}else{
				reject(`This email ${user.email} has already exit`);
			}
		}catch(e){
			reject(e);
		}
	});

};

let checkEmailUser = (email)=>{
	return new Promise((resolve, reject)=>{
		try{
			connection.query("SELECT * from users where email = ?", email, function(error, rows){
				if(error) reject(error);
				if(rows.length > 0) reject(true);
				reject(false);
			});
		}catch(e){
			reject(e);
		}
	});

};

module.exports = {
	createNewUser: createNewUser,
	checkEmailUser: checkEmailUser
}