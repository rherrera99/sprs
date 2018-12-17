import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Router } from "@angular/router";

@Component({
  selector: 'app-logindoctor',
  templateUrl: './logindoctor.component.html',
  styleUrls: ['./logindoctor.component.css']
})
export class LogindoctorComponent implements OnInit {

  logindrForm: any;

  constructor(private formBuilder: FormBuilder, private router: Router) {

    this.logindrForm = this.formBuilder.group({
      'username': ['', Validators.required],
      'password': ['', [Validators.required]],
      'remember_dr': ['']
      //'profile': ['', [Validators.required, Validators.minLength(10)]]
    });
  }

  loginDoctor() {
    if (this.logindrForm.dirty && this.logindrForm.valid) {
      if (this.logindrForm.value.username == 'doctor' && this.logindrForm.value.password == 'doctor') {
        this.router.navigateByUrl('/patients/add')
      }
    }

  }

  ngOnInit() {
  }

}
