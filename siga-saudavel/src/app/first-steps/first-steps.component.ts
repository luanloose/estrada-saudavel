import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-first-steps',
  templateUrl: './first-steps.component.html',
  styleUrls: ['./first-steps.component.scss']
})
export class FirstStepsComponent implements OnInit {

    step = 1;
    constructor() { }

    ngOnInit() {
    }

    next() {
      this.step++;
    }

}
