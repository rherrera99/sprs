import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Router } from "@angular/router";
import { APIService } from '../api.service';
import { AngularHttpProvider } from '../angular-http';
import { ActivatedRoute } from "@angular/router";

@Component({
  selector: 'app-ptforgot',
  templateUrl: './ptforgot.component.html',
  styleUrls: ['./ptforgot.component.css']
})
export class PtforgotComponent implements OnInit {
  loginptForm: any;
  server_response: string;
  theHtmlString: string;
  theHtmlStringsu:string;
  loading = false;
  flag:string;
  constructor(private formBuilder: FormBuilder, private router: Router, private apiService: APIService, private angularHttp: AngularHttpProvider,private activatedroute: ActivatedRoute) { 


    this.theHtmlString = "";
    this.theHtmlStringsu='';
	 const routeParams = this.activatedroute.snapshot.params;
    this.flag = '2';
    this.loginptForm = this.formBuilder.group({
      'email': ['', Validators.required]
      //'profile': ['', [Validators.required, Validators.minLength(10)]]
    });



  }
  submitForgot(){
  	if(this.flag=='1'){
     
  		this.forgotDoctor();
  	}else if(this.flag=='2'){
     
  		this.forgotPatient();
  	}
  }
  
  forgotPatient() {
    var contact = {
      email: this.loginptForm.value.email,
    };


    if (this.loginptForm.dirty && this.loginptForm.valid) {

      this.loading = true;
      this.angularHttp.post("ptforgot.json", contact)
        .toPromise()
        .then((response) => {
          this.server_response = JSON.stringify(response.json());
          var data = JSON.parse(this.server_response);
          //console.log(response.json());
          //console.log(data.status);
          if (data.status == 200) {

        
            this.loading = false;
            this.theHtmlString='';
            this.theHtmlStringsu = "Check Your mail For new password change link";
            //this.router.navigateByUrl('/readings/add');

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
  }
  
  forgotDoctor(){
  	var contact = {
      email: this.loginptForm.value.email,
    };


    if (this.loginptForm.dirty && this.loginptForm.valid) {

      this.loading = true;
      this.angularHttp.post("drforgot.json", contact)
        .toPromise()
        .then((response) => {
          this.server_response = JSON.stringify(response.json());
          var data = JSON.parse(this.server_response);
          //console.log(response.json());
          //console.log(data.status);
          if (data.status == 200) {

        
            this.loading = false;
            this.theHtmlString='';
            this.theHtmlStringsu = "Check Your mail For new password change link";
            //this.router.navigateByUrl('/readings/add');

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
  	
  }

  ngOnInit() {
    
  }

}
