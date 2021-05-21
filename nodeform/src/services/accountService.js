import connection from "../config/connectDB";

let createNewAccount = (data)=>{
	return new Promise((resolve, reject)=>{
		try{
			let check = checkAccount(data.account_number);
			if(!check)
			{
				connection.query("INSERT INTO account_details set ?", data, function(error, rows){
					if(error) reject(error);
					resolve("create a  new user succesfully");
				});
			}else{
				reject(`This account ${data.account_number} has already exit`);
			}
		}catch(e){
			reject(e);
		}
	});
};

let findAccountByAccount = (account)=>{
	return new Promise((resolve, reject)=>{
		try{
			connection.query("SELECT * from account_details where account_number = ?", account, function(error, rows){
				if(error) reject(error);
				let account =rows[0];
				resolve(account);
			});
		}catch(e){
			reject(e);
		}
	});
};

let findAccountById = (id) =>{
	return new Promise((resolve, reject)=>{
		try{
			connection.query("SELECT * from account_details where id = ?", id, function(error, rows){
				if(error) reject(error);
				let account =rows[0];
				resolve(account);
			});
		}catch(e){
			reject(e);
		}
	});
};

let findAccountByUser = (id) =>{
	return new Promise((resolve, reject)=>{
		try{
			connection.query("SELECT * from account_details where user_id = ?", id, function(error, rows){
				if(error) reject(error);
				let accounts =rows;
				resolve(accounts);
			});
		}catch(e){
			reject(e);
		}
	});
};

let checkAccount = (account)=>{
	return new Promise((resolve, reject)=>{
		try{
			connection.query("SELECT * from account_details where account_number = ?", account, function(error, rows){
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
	createNewAccount: createNewAccount,
	findAccountByUser: findAccountByUser,
	findAccountById: findAccountById,
	findAccountByAccount: findAccountByAccount
}