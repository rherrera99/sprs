import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { Router } from "@angular/router";
import { APIService } from '../api.service';
import { AngularHttpProvider } from '../angular-http';
import { ActivatedRoute } from "@angular/router";

@Component({
  selector: 'app-drforgotnew',
  templateUrl: './drforgotnew.component.html',
  styleUrls: ['./drforgotnew.component.css']
})
export class DrforgotnewComponent implements OnInit {
  loginptForm: any;
  server_response: string;
  theHtmlString: string;
  loading = false;
  theHtmlStringss:string;
  listID: string;
  constructor(private formBuilder: FormBuilder,private activatedroute: ActivatedRoute, private router: Router, private apiService: APIService, private angularHttp: AngularHttpProvider) { 

    this.theHtmlStringss=''
    this.theHtmlString = "";
    const routeParams = this.activatedroute.snapshot.params;
    this.listID = routeParams.id;
    this.loginptForm = this.formBuilder.group({

      'new_password': ['', Validators.required],
      'retype': ['', Validators.required]
      //'profile': ['', [Validators.required, Validators.minLength(10)]]
    });


  }
  loginPatient() {



    if (this.loginptForm.dirty && this.loginptForm.valid) {

      if (this.loginptForm.value.new_password == this.loginptForm.value.retype) {
        this.theHtmlString = '';

        var contact = {
          user_id : this.listID,
          password: this.loginptForm.value.new_password,

        };
        this.loading = true;
        this.angularHttp.post("resetPassword.json", contact)
          .toPromise()
          .then((response) => {
            this.server_response = JSON.stringify(response.json());
            var data = JSON.parse(this.server_response);
            //console.log(response.json());
            //console.log(data.status);
            if (data.status == 200) {


              this.loading = false;
              this.theHtmlStringss = "successful password changed Login with new password"
              //this.router.navigateByUrl('/readings/add');
              this.loginptForm.reset();

            } else {

              this.theHtmlString = data.message;
              this.loading = false;
              //alert(data.message);

            }


          })
          .catch((error) => {
            this.server_response = error._body;
          });



      }else {
        this.theHtmlString = "Password mismatch";
      }
    } 
  }

  ngOnInit() {
  }

}
