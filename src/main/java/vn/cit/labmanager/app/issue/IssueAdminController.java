package vn.cit.labmanager.app.issue;

import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.Arrays;
import java.util.Collections;
import java.util.Optional;

import org.apache.commons.lang3.StringUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import vn.cit.labmanager.app.lab.LabService;
import vn.cit.labmanager.app.user.User;
import vn.cit.labmanager.app.user.UserService;

@Controller
public class IssueAdminController {

	@Autowired
	private IssueService service;
	
	@Autowired
	private LabService labService;
	
	@Autowired
	private UserService userService;
	
	@RequestMapping(path = "/admin/issues/pending")
    public String indexPending(Model model) {
		Optional<Issue> lastModifiedIssue = service.findTopByOrderByModifiedDesc();
		String lastModification = lastModifiedIssue.map(Issue::getModified)
				.map(modified -> modified.format(DateTimeFormatter.ofPattern("hh':'mm a',' dd/MM/yyyy")))
				.orElse(StringUtils.EMPTY);
		
		model.addAttribute("issues", service.findByTracks_StatusInAndTracks_StatusNotIn(
				Arrays.asList(IssueStatus.Created, IssueStatus.Processing),
				Arrays.asList(IssueStatus.Done)));
		model.addAttribute("lastModification", lastModification);
        return "admin/issue/indexpending";
    }
	
	@RequestMapping(path = "/admin/issues/history")
    public String indexHistory(Model model) {
		Optional<Issue> lastModifiedIssue = service.findTopByOrderByModifiedDesc();
		String lastModification = lastModifiedIssue.map(Issue::getModified)
				.map(modified -> modified.format(DateTimeFormatter.ofPattern("hh':'mm a',' dd/MM/yyyy")))
				.orElse(StringUtils.EMPTY);
		
		model.addAttribute("issues", service.findByTracks_StatusInAndTracks_StatusNotIn(
				Arrays.asList(IssueStatus.Done),
				Collections.emptyList()));
		model.addAttribute("lastModification", lastModification);
        return "admin/issue/indexhistory";
    }
	
	@RequestMapping(path = "/admin/issues", method = RequestMethod.POST)
    public String saveIssue(Issue issue) {
		LocalDate createdDate = LocalDate.now();
		User creator = userService.getCurrentUser().orElse(null);
		if (issue.getTracks().isEmpty()) {
			IssueTracking track = new IssueTracking();
			track.setStatus(IssueStatus.Created);
			track.setNote("Thêm vấn đề.");
			track.setCreatedDate(createdDate);
			track.setCreatedUser(creator);
			issue.addTrack(track);
		}
		issue.setCreatedDate(createdDate);
		issue.setCreatedUser(creator);
		service.save(issue);
		return "redirect:/admin/issues/pending";
    }
	
	@RequestMapping(path = "/admin/issues/add")
    public String createIssue(Model model) {
        model.addAttribute("issue", new Issue());
        model.addAttribute("labs", labService.findAll());
        return "admin/issue/edit";   
    }
	
	@RequestMapping(path = "/admin/issues/edit/{id}")
    public String editIssue(@PathVariable(name = "id") String id, Model model) {
        Optional<Issue> issue = service.findOne(id);
        issue.ifPresent(item -> {
        	model.addAttribute("issue", item);
        	model.addAttribute("labs", labService.findAll());
        });
        return "admin/issue/edit";   
    }
	
	@RequestMapping(path = "/admin/issues/delete/{id}")
    public String deleteIssue(@PathVariable(name = "id") String id) {
        service.delete(id);
        return "redirect:/admin/issues/pending";   
    }

}
