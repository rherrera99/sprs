import { Component, OnInit } from '@angular/core';
import { Router } from "@angular/router";

@Component({
  selector: 'app-leftpane',
  templateUrl: './leftpane.component.html',
  styleUrls: ['./leftpane.component.css']
})
export class LeftpaneComponent implements OnInit {
  selectedItem;
  profile_pic_main: string;
  name: string;
  age: string;
  constructor(private router: Router) {
    if (!this.selectedItem) {
      // this.selectedItem = "addreadings";
    }
  }

  logout() {

    //var data = localStorage.getItem('token');
    localStorage.clear();
    localStorage.setItem('isLoggedIn', "false");
    this.router.navigateByUrl('/');

  }
  ngOnInit() {

    this.profile_pic_main = localStorage.getItem('profile_pic');
    this.name =  localStorage.getItem('name');
    this.age =  localStorage.getItem('Dob');
    /*if (!this.selectedItem) {
      this.selectedItem = "addreadings";
    }*/
    // if (this.selectedItem == "addreadings") {
    //   this.router.navigateByUrl('/readings/add')
    // } else if (this.selectedItem == "readings") {
    //   this.router.navigateByUrl('/readings/list')
    // } else if (this.selectedItem == "profile") {
    //   this.router.navigateByUrl('/profile')
    // } else if (this.selectedItem == "logout") {
    //   this.router.navigateByUrl('/')
    // }
  }


  // listClick(event, newValue) {


  //   if (newValue == "addreadings") {
  //     this.router.navigateByUrl('/readings/add')
  //   } else if (newValue == "readings") {
  //     this.router.navigateByUrl('/readings/list')
  //   } else if (newValue == "profile") {
  //     this.router.navigateByUrl('/profile')
  //   } else if (newValue == "logout") {
  //     this.router.navigateByUrl('/')
  //   }

  //   this.selectedItem = newValue;
  //   console.log(this.selectedItem + " Selected Item");
  // }





}
