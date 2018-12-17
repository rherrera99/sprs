import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Router } from "@angular/router";
import { APIService } from '../api.service';
import { AngularHttpProvider } from '../angular-http';

@Component({
  selector: 'app-logindoctor',
  templateUrl: './logindoctor.component.html',
  styleUrls: ['./logindoctor.component.css']
})
export class LogindoctorComponent implements OnInit {

  logindrForm: any;
  server_response: string;
  theHtmlString: string;
  submitted = false;
  loading = false;
  constructor(private formBuilder: FormBuilder, private router: Router,private apiService: APIService, private angularHttp: AngularHttpProvider) {

    this.theHtmlString = "";
    this.logindrForm = this.formBuilder.group({
      'username': ['',Validators.required],
      'password': ['',Validators.required],
      'remember_dr': ['']
      //'profile': ['', [Validators.required, Validators.minLength(10)]]
    });
  }
  get f() { return this.logindrForm.controls; }
  
  loginDoctor() {
    this.submitted=true;
    if (this.logindrForm.dirty && this.logindrForm.valid) {
      //if (this.logindrForm.value.username == 'doctor' && this.logindrForm.value.password == 'doctor') {
        var contact = {
          username: this.logindrForm.value.username,
          password: this.logindrForm.value.password
        };
        this.loading = true;
        this.angularHttp.post("doctorLogin.json", contact)
        .toPromise()
        .then((response) => {
          this.server_response = JSON.stringify(response.json());
          var data = JSON.parse(this.server_response);
          console.log(response.json());
          //console.log(data.status);
          if (data.status == 200) {
            this.loading = false;
            localStorage.setItem('isLoggedIn', "true");
            localStorage.setItem('token',data.data["doctorinfo"]['app_token'] );
            localStorage.setItem('dr_id',data.data["doctorinfo"]['id'] );
            localStorage.setItem('profile_pic',data.data["doctorinfo"]['profile_pic'] );
            localStorage.setItem('designation',data.data["doctorinfo"]['designation'] );
            localStorage.setItem('name',data.data["doctorinfo"]['first_name']+' '+data.data["doctorinfo"]['last_name'] );

            
            this.router.navigateByUrl('profile')
          } else {

            this.theHtmlString = data.message;
            this.loading = false;
            //alert(data.message);

          }


        })
        .catch((error) => {
          this.server_response = error._body;
        });
      }
      else{
        return;
      }
   // }

  }

  ngOnInit() {
  }

}
