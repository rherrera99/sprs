import { Component, OnInit } from '@angular/core';
import { Router } from "@angular/router";

@Component({
  selector: 'app-leftpanedr',
  templateUrl: './leftpanedr.component.html',
  styleUrls: ['./leftpanedr.component.css']
})
export class LeftpanedrComponent implements OnInit {

  profile_pic_main: string;
  name: string;
  designation: string;
  constructor(private router: Router) { }

  logout(){


    
    localStorage.clear();
    localStorage.setItem('isLoggedIn', "false");
    this.router.navigateByUrl('/');

  }

  ngOnInit() {

    this.profile_pic_main = localStorage.getItem('profile_pic');
    this.name =  localStorage.getItem('name');
    this.designation =  localStorage.getItem('designation');
//alert(this.profile_pic);
  }

}
