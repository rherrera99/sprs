import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Router } from "@angular/router";
import { APIService } from '../api.service';
import { AngularHttpProvider } from '../angular-http';
import { User } from '../_models';

@Component({
  selector: 'app-drchangepassword',
  templateUrl: './drchangepassword.component.html',
  styleUrls: ['./drchangepassword.component.css']
})
export class DrchangepasswordComponent implements OnInit {

  public loading = false;
  addpatientForm: any;
  server_response: string;
  theHtmlString: string;
  theHtmlString_ret: string;
  formcheckArray : Array<any> = [];
  theHtmlStringsu :string;
  formlist: User[] = [];
  submitted = false;
  constructor(private formBuilder: FormBuilder, private router: Router,private apiService: APIService, private angularHttp: AngularHttpProvider) { 

    this.theHtmlString="";
    this.theHtmlString_ret='';
    this.theHtmlStringsu='';
    this.addpatientForm = this.formBuilder.group({
      'old': ['', [Validators.required]],
      'new': ['', [Validators.required]],
      'ret': ['', [Validators.required]],

      //'profile': ['', [Validators.required, Validators.minLength(10)]]
    });

  }

  get f() { return this.addpatientForm.controls; }
  addDoctorPatient(){
    this.submitted=true;
    if (this.addpatientForm.dirty && this.addpatientForm.valid) {


      if(this.addpatientForm.value.new == this.addpatientForm.value.ret){
        this.theHtmlString_ret="";

        var contact = {
          dr_id : localStorage.getItem('dr_id'),
          old: this.addpatientForm.value.old,
          new: this.addpatientForm.value.new,

        }; 
       
        this.loading = true;
        this.angularHttp.post("drchnagepass.json", contact)
        .toPromise()
        .then((response) => {
          this.server_response = JSON.stringify(response.json());
          var data = JSON.parse(this.server_response);
          
          if (data.status == 200) {        
          // this.router.navigateByUrl('patients/list');
          this.theHtmlString=''
          this.theHtmlStringsu="password changed successfully.";
          this.loading = false;
          //this.addpatientForm.reset();
          } else {

            this.theHtmlString = data.message;
            this.loading = false;
            

          }


        })
        .catch((error) => {
          this.server_response = error._body;
          this.loading = false;
        });
      }else{

        this.theHtmlString_ret="Password mismatch";
      }
    }
  }
  ngOnInit() {
  }

}
