import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { StudentComponent } from './student/student.component';
import { SubmitComponent } from './submit/submit.component';

@NgModule({
  declarations: [
    AppComponent,
    StudentComponent,
    SubmitComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
     ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
