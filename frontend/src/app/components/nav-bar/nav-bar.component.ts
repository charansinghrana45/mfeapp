import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';


@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrls: ['./nav-bar.component.css']
})
export class NavBarComponent implements OnInit {

  name: string;
  loggedIn: boolean;	

  constructor(private auth: AuthService, private router: Router) { 

  	this.name = "Charan Singh";
  	this.auth.authStatus.subscribe(value => this.loggedIn = value);
  }

  ngOnInit() {

  }

  logoutMe(event) {
 
  	event.preventDefault();
  	this.auth.changeAuthStaus(false);

    // console.log(this.loggedIn);

  	this.router.navigate(['/login']);
  }

}
