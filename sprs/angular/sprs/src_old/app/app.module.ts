import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { LoginComponent } from './login/login.component';
import { LeftpaneComponent } from './leftpane/leftpane.component';
import { HeaderloginComponent } from './headerlogin/headerlogin.component';
import { AddratingComponent } from './addrating/addrating.component';
import { FooterComponent } from './footer/footer.component';
import { LogindoctorComponent } from './logindoctor/logindoctor.component';
import { LoginpatientComponent } from './loginpatient/loginpatient.component';
import { PagenotfoundComponent } from './pagenotfound/pagenotfound.component';
import { HomeComponent } from './home/home.component';
import { ReadinglistComponent } from './readinglist/readinglist.component';
import { DrprofileComponent } from './drprofile/drprofile.component';
import { AddpatientComponent } from './addpatient/addpatient.component';
import { LeftpanedrComponent } from './leftpanedr/leftpanedr.component';
import { PtprofileComponent } from './ptprofile/ptprofile.component';
import { PatientlistComponent } from './patientlist/patientlist.component';
import { ReadingsComponent } from './readings/readings.component';
import { PtreadingsComponent } from './ptreadings/ptreadings.component';

const appRoutes: Routes = [
  { path: '', component: LoginComponent },
  
  { path: 'logout', component: LoginComponent },
  {
    path: 'readings/add', component: AddratingComponent
  },
  {
    path: 'readings/list', component: ReadinglistComponent
  },
  {
    path: 'profile', component: DrprofileComponent
  },
  {
    path: 'myprofile', component: PtprofileComponent
  },
  {
    path: 'patients/add', component: AddpatientComponent
  },
  {
    path: 'patients/list', component: PatientlistComponent
  },
  {
    path: 'patient/readings', component: PtreadingsComponent
  },
  // { path: 'readings', component: HomeComponent },
  // { path: 'profile', component: HomeComponent },
  // { path: 'logout', component: HomeComponent },
  
  { path: '**', component: PagenotfoundComponent }
];


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    LoginComponent,
    LeftpaneComponent,
    HeaderloginComponent,
    AddratingComponent,
    FooterComponent,
    LogindoctorComponent,
    LoginpatientComponent,
    PagenotfoundComponent,
    HomeComponent,
    ReadinglistComponent,
    DrprofileComponent,
    AddpatientComponent,
    LeftpanedrComponent,
    PtprofileComponent,
    PatientlistComponent,
    ReadingsComponent,
    PtreadingsComponent,
  ],
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    RouterModule.forRoot(
      appRoutes,
      { enableTracing: true } // <-- debugging purposes only
    )
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
