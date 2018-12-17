import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ReadinglistComponent } from './readinglist.component';

describe('ReadinglistComponent', () => {
  let component: ReadinglistComponent;
  let fixture: ComponentFixture<ReadinglistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ReadinglistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ReadinglistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
