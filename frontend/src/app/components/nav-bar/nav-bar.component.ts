import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../services/auth.service';
import { TokenService } from '../../services/token.service';
import { Router } from '@angular/router';


@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrls: ['./nav-bar.component.css']
})
export class NavBarComponent implements OnInit {

  name: string;
  loggedIn: boolean;	

  constructor(private auth: AuthService, private router: Router, private token: TokenService) { 

  	this.auth.authStatus.subscribe(value => this.loggedIn = value);

    this.auth.authUserData.subscribe(value => this.name = value);
  }

  ngOnInit() {

  }

  logoutMe(event) {
 
     event.preventDefault();
     this.auth.logout();
  }

}
