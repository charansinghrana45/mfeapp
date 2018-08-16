import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  form: object = {};
  errors: object= {};

  constructor(private auth: AuthService, private router: Router) { }

  ngOnInit() {
  }

  doLogin() {

  	let logingInfo = this.auth.login(this.form);

  	if(logingInfo === true) {
  		this.auth.changeAuthStaus(true);
  		this.router.navigateByUrl('/home');
  	}
  	else {
  		this.errors = {credentials: "Oops! Email or Password is incorrect"};
  	}

  }

}
