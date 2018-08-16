import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { AuthService } from '../../services/auth.service';
import { TokenService } from '../../services/token.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  form: object = {};
  errors: object= {};
  
  constructor(private auth: AuthService, private router: Router, private token: TokenService) { }

  ngOnInit() {
  }

  doLogin() {

  	this.auth.login(this.form).subscribe(response => this.handleResponse(response), 
                                        (error) => this.handleError(error));
  }

  handleResponse(response) {
    this.token.handleToken(response.token);

    this.token.handleUserData(response.data);

    this.auth.changeAuthUserData(this.token.getUserData());

    this.auth.changeAuthStaus(this.token.isLoggedIn());

    this.router.navigateByUrl('/home');
  }

  handleError(error) {
    this.errors = {credentials: error.error.error}
  }

}
