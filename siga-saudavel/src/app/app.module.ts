import { BrowserModule } from "@angular/platform-browser";
import { NgModule } from "@angular/core";

import { AppRoutingModule } from "./app-routing.module";
import { AppComponent } from "./app.component";
import { FirstStepsComponent } from "./first-steps/first-steps.component";
import { FindRoutesComponent } from './find-routes/find-routes.component';
import { GoalsComponent } from './goals/goals.component';
import { PointsComponent } from './points/points.component';
import { HealthComponent } from './health/health.component';
import { MenuAppComponent } from './menu-app/menu-app.component';

@NgModule({
  declarations: [AppComponent, FirstStepsComponent, FindRoutesComponent, GoalsComponent, PointsComponent, HealthComponent, MenuAppComponent],
  imports: [BrowserModule, AppRoutingModule],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule {}
