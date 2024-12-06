import { Tooltip } from 'bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// Initialize tooltips
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new Tooltip(tooltipTriggerEl));
