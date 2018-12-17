import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Router } from "@angular/router";

@Component({
  selector: 'app-loginpatient',
  templateUrl: './loginpatient.component.html',
  styleUrls: ['./loginpatient.component.css']
})
export class LoginpatientComponent implements OnInit {
  loginptForm: any;

  constructor(private formBuilder: FormBuilder,private router: Router) {

    this.loginptForm = this.formBuilder.group({
      'username': ['', Validators.required],
      'password': ['', [Validators.required]],
      'remember_pt':['']
      //'profile': ['', [Validators.required, Validators.minLength(10)]]
    });
  }

  loginPatient() {
    if (this.loginptForm.dirty && this.loginptForm.valid) {
      //alert(`Username: ${this.loginptForm.value.username} password: ${this.loginptForm.value.password}`);
      if(this.loginptForm.value.username=='patient' && this.loginptForm.value.password=='patient'){
        this.router.navigateByUrl('/readings/add')
      }
      
    }
  }




  ngOnInit() {
  }

}
