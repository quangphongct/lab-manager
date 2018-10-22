package vn.cit.labmanager.app.tool;

import java.util.ArrayList;
import java.util.List;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToMany;
import javax.persistence.PreRemove;

import org.hibernate.annotations.GenericGenerator;

import lombok.Data;
import lombok.EqualsAndHashCode;
import vn.cit.labmanager.app.lab.Lab;
import vn.cit.labmanager.config.auditing.AuditableEntity;

@Entity
@Data
@EqualsAndHashCode(callSuper = false)
public class Tool extends AuditableEntity {
	
	@Id
    @GeneratedValue(strategy = GenerationType.AUTO, generator = "system-uuid")
    @GenericGenerator(name = "system-uuid", strategy = "uuid2")
	private String id;
	private String name;
	
	@ManyToMany(mappedBy="tools")
	private List<Lab> labs = new ArrayList<>();
	
	@PreRemove
	private void preRemove() {
		for(Lab lab : labs) {
			lab.getTools().clear();
		}
	}

}